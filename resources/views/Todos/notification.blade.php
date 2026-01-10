<style>
    .icon-wrapper {
        position: relative;
        cursor: pointer;
        border-radius: 8px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-wrapper.selected {
        /* No background or border for selected state */
    }

    /* Message icon active/inactive states */
    .icon-wrapper .message-icon-inactive,
    .icon-wrapper .message-icon-active {
        width: 30px !important;
        height: 30px !important;
        object-fit: contain;
    }

    /* Default state: Show inactive, hide active */
    .icon-wrapper .message-icon-inactive {
        display: block !important;
    }
    .icon-wrapper .message-icon-active {
        display: none !important;
    }

    /* Active state: Show active icon, hide inactive */
    .icon-wrapper.selected .message-icon-inactive {
        display: none !important;
    }
    .icon-wrapper.selected .message-icon-active {
        display: block !important;
    }

    /* Task icon (notification) active/inactive states */
    .icon-wrapper .task-icon-inactive,
    .icon-wrapper .task-icon-active {
        width: 30px !important;
        height: 30px !important;
        object-fit: contain;
    }

    /* Default state: Show inactive, hide active */
    .icon-wrapper .task-icon-inactive {
        display: block !important;
    }
    .icon-wrapper .task-icon-active {
        display: none !important;
    }

    /* Active state: Show active icon, hide inactive */
    .icon-wrapper.selected .task-icon-inactive {
        display: none !important;
    }
    .icon-wrapper.selected .task-icon-active {
        display: block !important;
    }

    /* Menu icon (layers) active/inactive states */
    .icon-wrapper .menu-icon-inactive,
    .icon-wrapper .menu-icon-active {
        width: 30px !important;
        height: 30px !important;
        object-fit: contain;
    }

    /* Default state: Show inactive, hide active */
    .icon-wrapper .menu-icon-inactive {
        display: block !important;
    }
    .icon-wrapper .menu-icon-active {
        display: none !important;
    }

    /* Active state: Show active icon, hide inactive */
    .icon-wrapper.selected .menu-icon-inactive {
        display: none !important;
    }
    .icon-wrapper.selected .menu-icon-active {
        display: block !important;
    }

    /* Notification icon (bell) active/inactive states */
    .icon-wrapper .notification-icon-inactive,
    .icon-wrapper .notification-icon-active {
        width: 30px !important;
        height: 30px !important;
        object-fit: contain;
    }

    /* Default state: Show inactive, hide active */
    .icon-wrapper .notification-icon-inactive {
        display: block !important;
    }
    .icon-wrapper .notification-icon-active {
        display: none !important;
    }

    /* Active state: Show active icon, hide inactive */
    .icon-wrapper.selected .notification-icon-inactive {
        display: none !important;
    }
    .icon-wrapper.selected .notification-icon-active {
        display: block !important;
    }
</style>


<div class="sidebar-group">
    <div class="tab-content" style=" box-sizing: border-box;">
        <div class="tab-pane fade active show " id="chat-menu">
            <!-- Chats sidebar -->
            <div class="slimscroll">

                <!-- Parent Container -->
                <!-- Icons Row -->
                <div id="iconBar" style="background-color: #fff; border-radius: 12px; padding: 10px 20px; display: flex; justify-content:space-between;margin:20px;">
                    <!-- Icon 1 -->
                    <div class="icon-wrapper selected" onclick="showTab('layers')" id="icon-layers">
                        <img src="{{ asset('assets/img/icons/menuIconInactive.svg') }}" class="menu-icon-inactive" style="width: 30px; height: 30px; object-fit: contain;">
                        <img src="{{ asset('assets/img/icons/menuIconActive.svg') }}" class="menu-icon-active" style="width: 30px; height: 30px; object-fit: contain;">
                    </div>

                    <!-- Icon 2 -->
                    <div class="icon-wrapper" onclick="showTab('bell')" id="icon-bell">
                        <img src="{{ asset('assets/img/icons/notificationIconInactive.svg') }}" class="notification-icon-inactive" style="width: 30px; height: 30px; object-fit: contain;">
                        <img src="{{ asset('assets/img/icons/notificationIconActive.svg') }}" class="notification-icon-active" style="width: 30px; height: 30px; object-fit: contain;">
                    </div>

                    <!-- Icon 3 -->
                    <div class="icon-wrapper" onclick="showTab('notifi')" id="icon-notifi">
                        <img src="{{ asset('assets/img/icons/taskIconInactive.svg') }}" class="task-icon-inactive" style="width: 30px; height: 30px; object-fit: contain;">
                        <img src="{{ asset('assets/img/icons/taskIconActive.svg') }}" class="task-icon-active" style="width: 30px; height: 30px; object-fit: contain;">
                    </div>

                    <!-- Icon 4 -->
                    <div class="icon-wrapper" onclick="showTab('message')" id="icon-message">
                        <img src="{{ asset('assets/img/icons/messageIconInactive.svg') }}" class="message-icon-inactive" style="width: 30px; height: 30px; object-fit: contain;">
                        <img src="{{ asset('assets/img/icons/messgeIconActive.svg') }}" class="message-icon-active" style="width: 30px; height: 30px; object-fit: contain;">
                    </div>
                </div>

                <!-- Content Section -->
                <!-- team -->
                <div id="tab-layers" class="tab-content" style="display: block;">
                    <div style="background-color: #fff; border-radius: 12px; padding: 20px; margin: 20px;">
                        <!-- Header -->
                        <div style="margin-bottom: 20px;">
                            <h6 style="font-weight: 600; color: #2e3a59; font-size: 16px; margin-bottom: 4px;">Team Chat</h6>
                            <small style="color: #7f8ea3;">Public Groups</small>
                        </div>
                        <!-- Scrollable Card Container -->
                        <div id="cardScroller"
                            style="display: flex; gap: 16px; overflow-x: auto; scroll-behavior: smooth; padding-bottom: 16px; -ms-overflow-style: none; scrollbar-width: none;"
                            onscroll=" var scroller=this; var containerWidth=scroller.offsetWidth; var index=Math.round(scroller.scrollLeft/containerWidth); for(var i=0;i<3;i++){ var dot=document.getElementById('dot'+i); dot.style.background=(i===index)?'#00c469':'#d4d4d4'; dot.style.width=(i===index)?'40px':'20px'; } ">

                            <style>
                                #cardScroller::-webkit-scrollbar {
                                    display: none;
                                }
                            </style>

                            <!-- CARD 1 -->
                            <div style="flex: 0 0 auto; width: 110px; border-radius: 16px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); text-align: center; height: 115px;">
                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="position: relative; margin-top: -20px;">
                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 2px solid limegreen; background: white;">
                                </div>
                                <div style="padding: 8px;">
                                    <h6 style="font-weight: 600; font-size: 11px; color: #000; margin: 0;">Team A</h6>
                                    <p style="margin: 0; color: #7f8ea3; font-size: 10px;">5 Users</p>
                                </div>
                            </div>

                            <!-- CARD 2 -->
                            <div style="flex: 0 0 auto; width: 110px; border-radius: 16px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); text-align: center; height: 115px;">
                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="position: relative; margin-top: -20px;">
                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 2px solid limegreen; background: white;">
                                </div>
                                <div style="padding: 8px;">
                                    <h6 style="font-weight: 600; font-size: 11px; color: #000; margin: 0;">Team B</h6>
                                    <p style="margin: 0; color: #7f8ea3; font-size: 10px;">7 Users</p>
                                </div>
                            </div>

                            <!-- CARD 3 -->
                            <div style="flex: 0 0 auto; width: 110px; border-radius: 16px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); text-align: center; height: 115px;">
                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="position: relative; margin-top: -20px;">
                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 2px solid gold; background: white;">
                                </div>
                                <div style="padding: 8px;">
                                    <h6 style="font-weight: 600; font-size: 11px; color: #000; margin: 0;">Team C</h6>
                                    <p style="margin: 0; color: #7f8ea3; font-size: 10px;">9 Users</p>
                                </div>
                            </div>
                            <div style="flex: 0 0 auto; width: 110px; border-radius: 16px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); text-align: center; height: 115px;">
                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="position: relative; margin-top: -20px;">
                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 2px solid gold; background: white;">
                                </div>
                                <div style="padding: 8px;">
                                    <h6 style="font-weight: 600; font-size: 11px; color: #000; margin: 0;">Team C</h6>
                                    <p style="margin: 0; color: #7f8ea3; font-size: 10px;">9 Users</p>
                                </div>
                            </div>
                            <!-- team -->
                            <div style="flex: 0 0 auto; width: 110px; border-radius: 16px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); text-align: center; height: 115px;">
                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="position: relative; margin-top: -20px;">
                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 2px solid gold; background: white;">
                                </div>
                                <div style="padding: 8px;">
                                    <h6 style="font-weight: 600; font-size: 11px; color: #000; margin: 0;">Team C</h6>
                                    <p style="margin: 0; color: #7f8ea3; font-size: 10px;">9 Users</p>
                                </div>
                            </div>
                        </div>

                        <!-- Dot Indicator -->
                        <div style="display: flex; justify-content: center; gap: 10px; margin-top: 10px;">
                            <div id="dot0"
                                style="width: 40px; height: 5px; border-radius: 8px; background: #00c469; cursor: pointer;"
                                onclick=" var scroller=document.getElementById('cardScroller'); var containerWidth=scroller.offsetWidth; scroller.scrollTo({left:0*containerWidth,behavior:'smooth'}); for(var i=0;i<3;i++){ var dot=document.getElementById('dot'+i);  dot.style.background=(i===0)?'#00c469':'#d4d4d4';  dot.style.width=(i===0)?'40px':'20px'; } ">
                            </div>
                            <div id="dot1"
                                style="width: 20px; height: 5px; border-radius: 8px; background: #d4d4d4; cursor: pointer;"
                                onclick=" var scroller=document.getElementById('cardScroller'); var containerWidth=scroller.offsetWidth; scroller.scrollTo({left:1*containerWidth,behavior:'smooth'}); for(var i=0;i<3;i++){ var dot=document.getElementById('dot'+i); dot.style.background=(i===1)?'#00c469':'#d4d4d4'; dot.style.width=(i===1)?'40px':'20px'; } ">
                            </div>
                            <div id="dot2"
                                style="width: 20px; height: 5px; border-radius: 8px; background: #d4d4d4; cursor: pointer;"
                                onclick=" var scroller=document.getElementById('cardScroller'); var containerWidth=scroller.offsetWidth; scroller.scrollTo({left:2*containerWidth,behavior:'smooth'}); for(var i=0;i<3;i++){ var dot=document.getElementById('dot'+i); dot.style.background=(i===2)?'#00c469':'#d4d4d4'; dot.style.width=(i===2)?'40px':'20px'; } ">
                            </div>
                        </div>
                    </div>
                    <!-- tasks -->
                    <div style="background:#fff; border-radius: 10px; padding: 10px; margin: 20px; font-family: sans-serif;">

                        <!-- Header Row -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <h5 style="margin: 0; font-weight: 600; font-size: 15px;">Task Status</h5>
                            <i class="bi bi-pin-fill" style="color: red; font-size: 18px; transform: rotate(45deg);"></i>
                        </div>

                        <!-- Cards Row (No overflow) -->
                        <div style="display: flex; gap: 6px; justify-content: space-between; flex-wrap: nowrap; overflow-x: hidden;">

                            <!-- CARD -->
                            <div style="flex: 1; max-width: 80px; background: #e2e8f0; border-radius: 10px; padding: 8px; text-align: center;">
                                <img src="{{ asset('build/img/inhold.svg') }}" style="width: 24px;" alt="">
                                <div style="font-size: 11px; color: #4b5c74; margin-top: 4px;">In Hold</div>
                                <div style="font-weight: 600; font-size: 12px;">2</div>
                            </div>

                            <div style="flex: 1; max-width: 80px; background: #e2e8f0; border-radius: 10px; padding: 8px; text-align: center;">
                                <img src="{{ asset('build/img/incheck.svg') }}" style="width: 24px;" alt="">
                                <div style="font-size: 11px; color: #4b5c74; margin-top: 4px;">In Check</div>
                                <div style="font-weight: 600; font-size: 12px;">2</div>
                            </div>

                            <div style="flex: 1; max-width: 80px; background: #e2e8f0; border-radius: 10px; padding: 8px; text-align: center;">
                                <img src="{{ asset('build/img/delayed.svg') }}" style="width: 24px;" alt="">
                                <div style="font-size: 11px; color: #4b5c74; margin-top: 4px;">Delayed</div>
                                <div style="font-weight: 600; font-size: 12px;">2</div>
                            </div>

                            <div style="flex: 1; max-width: 80px; background: #e2e8f0; border-radius: 10px; padding: 8px; text-align: center;">
                                <img src="{{ asset('build/img/rejected.svg') }}" style="width: 24px;" alt="">
                                <div style="font-size: 11px; color: #4b5c74; margin-top: 4px;">Rejected</div>
                                <div style="font-weight: 600; font-size: 12px;">2</div>
                            </div>

                        </div>
                    </div>
                    <!-- members online -->
                    <div style="background: #fff; border-radius: 12px; padding: 12px 16px; margin: 20px; position: relative; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">

                        <!-- Header -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <span style="font-weight: 600; color: #2e3a59; font-size: 16px;">Member Online</span>
                            <i class="bi bi-pin-fill" style="color: red; font-size: 18px; transform: rotate(45deg);"></i>
                        </div>

                        <!-- Avatars Row -->
                        <div style="display: flex; gap: 12px;">

                            <!-- Avatar 1 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px;   padding: 5px;">

                            </div>

                            <!-- Avatar 2 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px; padding: 5px;">

                            </div>

                            <!-- Avatar 3 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px;  padding: 5px;">

                            </div>

                            <!-- Avatar 4 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px;  padding: 5px;">

                            </div>

                            <!-- Avatar 5 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px;  padding: 5px;">

                            </div>

                        </div>
                    </div>
                    <!-- archive chat -->
                    <div style="background: #fff; border-radius: 12px; padding: 12px 16px; margin: 20px; position: relative; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">

                        <!-- Header -->
                        <div style="display: flex; justify-content: space-between; align-items: center; ">
                            <span style="font-weight: 600; color: #2e3a59; font-size: 16px;">Archive Chat</span>

                            <i class="bi bi-pin-fill" style="color: red; font-size: 18px; transform: rotate(45deg);"></i>
                        </div>
                        <p>single & team chat</p>

                        <!-- Avatars Row -->
                        <div style="display: flex; gap: 12px;">

                            <!-- Avatar 1 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px;   padding: 5px;">

                            </div>

                            <!-- Avatar 2 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px; padding: 5px;">

                            </div>

                            <!-- Avatar 3 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px;  padding: 5px;">

                            </div>

                            <!-- Avatar 4 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px;  padding: 5px;">

                            </div>

                            <!-- Avatar 5 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px;  padding: 5px;">

                            </div>

                        </div>
                    </div>
                    <!-- project card -->
                    <div>
                        <!-- Start of Card 1 -->
                        <div class="card" style=" height:fit-content;padding: 12px 16px; margin: 20px;  border-radius: 12px; font-family: 'Segoe UI', sans-serif; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow: hidden;">

                            <!-- Header -->
                            <div class="d-flex justify-content-between align-items-start p-2 pt-3">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                    <div>
                                        <h6 class="m-0 fw-bold" style="font-size: 13px; color: #1e293b;">Title of Meeting</h6>
                                        <small style="color: #6b7280; font-size: 11px;">Project Title</small>
                                    </div>
                                </div>
                                <i class="bi bi-pin-fill" style="color: red; font-size: 18px; transform: rotate(45deg); display: inline-block;"></i>

                            </div>

                            <!-- Description -->
                            <div class="px-3 pt-1 pb-0" style="font-size: 12px; color: #6b7280; line-height: 1.4;">
                                Here we will add the description of the ToDo Only you is Superadmin ToDo
                            </div>

                            <!-- Avatars + user count -->
                            <div class="text-center mt-2">
                                <div style="position: relative; display: inline-block; height: 40px; width: 108px;">
                                    <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" alt="icon" style="position: absolute; left: 0; z-index: 3; width: 36px; height: 36px; border: 2px solid #22c55e;">
                                    <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 20px; z-index: 2; width: 36px; height: 36px; border: 2px solid #3b82f6;">
                                    <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 40px; z-index: 1; width: 36px; height: 36px; border: 2px solid #facc15;">
                                    <img src="{{URL::asset('/build/img/groups/group-01.jpg')}}" class="rounded-circle" style="position: absolute; left: 60px; z-index: 0; width: 36px; height: 36px; border: 2px solid #ef4444;">
                                </div>
                                <div style="font-size: 12px; color: #1e293b; font-weight: 500;">1 user online</div>
                            </div>

                            <!-- Status Row -->
                            <div class="d-flex align-items-center justify-content-between px-3 py-2 mt-2" style="font-size: 12px; border-radius: 10px; background: #f8f8f8;">
                                <!-- Green dot -->
                                <div class="d-flex align-items-center gap-2">
                                    <span style="width: 12px; height: 12px; background-color: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                </div>

                                <!-- Divider -->
                                <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                <!-- Bell Icon -->
                                <img src="{{URL::asset('/build/img/bell.svg')}}" alt="Image" style="width: 20px;height:20px;" class="rounded-circle">

                                <!-- Divider -->
                                <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                <!-- "Now" Text -->
                                <span style="color: red; font-weight: 500;">
                                    <img src="{{URL::asset('/build/img/timeicon.svg')}}" alt="Image" style="width: 20px;height:20px;"> Now</span>

                                <!-- Divider -->
                                <div style="width: 1px; height: 16px; background-color: #e0e0e0;"></div>

                                <!-- Clock Icon + Time -->
                                <div class="d-flex align-items-center gap-1">

                                    <img src="{{URL::asset('/build/img/Clock.svg')}}" alt="Image" style="width: 20px;height:20px;">
                                    <span style="color: #ef4444;">17:30 - 18:00</span>
                                </div>
                            </div>

                            <!-- Join Now Button -->
                            <div class="text-center py-2">
                                <button style=" background-color: #22c55e; color: white; padding: 6px 18px; border: none; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                                    Join now
                                    <img src="{{ URL::asset('/build/img/Logout1.svg') }}" alt="arrow" style="width: 16px; height: 16px;" />
                                </button>
                            </div>


                        </div>
                    </div>

                    @forelse($todayTodos as $todo)
                    <!-- ToDo -->
                    <div class="card" style=" border-radius: 12px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1); height:max-content;margin: 20px;">
                        <!-- Card Header -->
                        
                        
                        <div class="d-flex justify-content-between align-items-center" style="background-color: #ececec;">
                            <div class="d-flex">
                                <img src="{{ asset('storage/' . $todo->user->profile_image) }}" class=" me-2" alt="image" style="width: 40px; height: 40px;">
                                <div>
                                    <div style="font-weight: bold;">{{$todo->user->name}}</div>
                                    <small style="color: gray;">{{ $todo->created_at->format('d:m:y - H:i') }}</small>
                                </div>
                            </div>
                            <div style="font-size: 20px; cursor: pointer; margin-right:12px">&#8942;</div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body ">
                            <!-- Title & Avatars -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0 fw-bold" style="font-size: 14px;">{{$todo->title}}</h6>
                                        @if($todo->is_private == 0)
                                                        <small class="text-muted">
                                                            <img src="{{URL::asset('/build/img/share.svg')}}" style="width: 20px; height: 20px;" /> Shared
                                                        </small>
                                                    @else
                                                        <small class="text-muted">
                                                            <img src="{{ asset('storage/' . $todo->user->profile_image) }}" class="rounded-circle me-1" alt="image" style="width: 20px; height: 20px;"> private
                                                        </small>
                                                    @endif
                                    </div>
                                </div>
                                <!-- Avatars -->
                                <div class="d-flex" style="margin-left: auto;">
                                    <div style="position: relative; width: 60px; height: 30px;">
                                       
                                    </div>
                                </div>
                            </div>


                            <!-- Description -->
                            <p class="mb-3 mt-3" style="font-size: 13px; color: #333;">
                                
                            </p>

                            <!-- Date & Priority Row -->
                            <div class="d-flex justify-content-between align-items-center p-1 rounded" style="background-color: #f8f8f8; font-size: 11px;margin-top: 20px;border-radius:10px;">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-success fw-semibold">Start:</span>
                                    <span>{{$todo->start_time}}</span>
                                    <span class="text-muted">|</span>
                                    <span class="text-success fw-semibold">Deliver:</span>
                                    <span style="color: #f44336;">Today</span>
                                </div>
                                <div class="d-flex align-items-center gap-1" style="background: #fff; padding: 2px 8px; border-radius: 12px;">
                                    <span style="width: 8px; height: 8px; background-color: #4caf50; border-radius: 50%;"></span>
                                    <span style="color: #4caf50; font-weight: 500;">{{$todo->priority}}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Button -->
                        <div class="d-flex justify-content-center py-2" style="margin-top: -10px;">
                            <button style="background-color: #fbbc05; color: white; border: none; padding: 6px 20px; border-radius: 10px; font-size: 14px; font-weight: 500;margin-bottom:3px;">
                                Need Counte
                            </button>
                        </div>
                    </div>
                    @empty
                    @endforelse



                </div>

                <!-- notifiactions -->
                <div id="tab-bell" class="tab-content" style="display: none;">
                    <!-- Delete All Button -->
                    <div style="display: flex; justify-content: flex-end; padding: 10px; margin-bottom: -10px;">
                        <div onclick="deleteNotificationCards()"
                            style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #f9fafc; border-radius: 8px; cursor: pointer; font-family: sans-serif;">
                            <img src="{{ asset('build/img/del.svg') }}" alt="Delete" style="width: 18px; height: 18px;">
                            <span style="font-size: 14px; color: #2e3a59;">Delete all</span>
                        </div>
                    </div>

                    <!-- Notification Cards Wrapper -->
                    <div id="notificationWrapper">
                        <!-- Notification Card 1 -->
                        <div class="notificationCard"
                            style="position: relative; background: #fff; border-radius: 12px; padding: 12px 14px; display: flex; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05); font-family: sans-serif; margin: 10px 20px;">

                            <!-- Profile Image -->
                            <div style="width: 45px; height: 45px; border-radius: 50%; border: 2px solid limegreen; overflow: hidden; margin-right: 10px;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <!-- Text Content -->
                            <div style="flex-grow: 1;">
                                <div style="font-weight: 600; font-size: 14px; color: #2e3a59;">Developer name</div>
                                <div style="font-size: 12px; color: #7f8ea3;">Developer is now Online</div>
                            </div>

                            <!-- Top Right Time -->
                            <div style="position: absolute; top: 10px; right: 14px; font-size: 12px; color: #9ba3ae;">
                                1h
                            </div>

                            <!-- Bottom Right Red Dot -->
                            <div style="position: absolute; bottom: 10px; right: 14px; width: 10px; height: 10px; background: red; border-radius: 50%;"></div>
                        </div>

                        <!-- Notification Card 2 -->
                        <div class="notificationCard"
                            style="position: relative; background: #fff; border-radius: 12px; padding: 12px 14px; display: flex; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05); font-family: sans-serif; margin: 10px 20px;">

                            <!-- Profile Image -->
                            <div style="width: 45px; height: 45px; border-radius: 50%; border: 2px solid limegreen; overflow: hidden; margin-right: 10px;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <!-- Text Content -->
                            <div style="flex-grow: 1;">
                                <div style="font-weight: 600; font-size: 14px; color: #2e3a59;">Developer name</div>
                                <div style="font-size: 12px; color: #7f8ea3;">Developer is now Online</div>
                            </div>

                            <!-- Top Right Time -->
                            <div style="position: absolute; top: 10px; right: 14px; font-size: 12px; color: #9ba3ae;">
                                1h
                            </div>

                            <!-- Bottom Right Red Dot -->
                            <div style="position: absolute; bottom: 10px; right: 14px; width: 10px; height: 10px; background: red; border-radius: 50%;"></div>
                        </div>
                    </div>
                    <!-- Inline JS (no <script>) -->
                    <img onerror="  function deleteNotificationCards() { var cards = document.querySelectorAll('.notificationCard'); cards.forEach(function(card) { card.remove(); });} " style="display: none;">
                </div>
                <!-- tasks -->
                <!-- Delete All Button -->

                <div id="tab-notifi" class="tab-content" style="display: none;">
                    <div style="display: flex; justify-content: flex-end; padding: 10px; margin-bottom: -10px;">
                        <div onclick="deleteNotificationCards()"
                            style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #f9fafc; border-radius: 8px; cursor: pointer; font-family: sans-serif;">
                            <img src="{{ asset('build/img/del.svg') }}" alt="Delete" style="width: 18px; height: 18px;">
                            <span style="font-size: 14px; color: #2e3a59;">Delete all</span>
                        </div>
                    </div>
                    <!-- Notification Card -->
                    <!-- inhold -->
                    <div style="position: relative; background: #fff; border-radius: 12px; padding: 12px 14px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); font-family: sans-serif; margin: 10px 20px;">

                        <!-- Top Row: Icon + Title -->
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <!-- Task Icon -->
                            <img src="{{ asset('build/img/inhold.svg') }}" alt="Task Icon" style="width: 28px; height: 28px;">

                            <!-- Title and Time -->
                            <div style="flex-grow: 1;">
                                <div style="font-weight: 600; font-size: 14px; color: #2e3a59;">Task Title - Project Name</div>
                                <div style="font-size: 12px; color: #7f8ea3;">Set the Task ID #2 - to <span style="color: orange; font-weight: 600;">In Hold</span></div>
                            </div>
                        </div>

                        <!-- User and Reason -->
                        <div style="display: flex; align-items: flex-start; gap: 8px; margin-top: 10px; background: #fff4f2; padding: 6px 10px; border-radius: 8px; font-size: 12px;width: fit-content;">
                            <!-- Avatar -->
                            <div style="min-width: 26px; height: 26px; border-radius: 50%; overflow: hidden;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <!-- Username and Reason -->
                            <div>
                                <span style="color: #2e3a59; font-weight: 600;">Username</span>
                                <span style="color: red; font-weight: 500;"> &nbsp; ! We will get the Reason here</span>
                            </div>
                        </div>

                        <!-- Time Top Right -->
                        <div style="position: absolute; top: 10px; right: 14px; font-size: 12px; color: #9ba3ae;">
                            1h
                        </div>

                        <!-- Red Dot Bottom Right -->
                        <div style="position: absolute; bottom: 26px; right: 14px; width: 10px; height: 10px; background: red; border-radius: 50%;"></div>
                    </div>
                    <!-- incheck -->
                    <div style="position: relative; background: #fff; border-radius: 12px; padding: 12px 14px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); font-family: sans-serif; margin: 10px 20px;">

                        <!-- Top Row: Icon + Title -->
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <!-- Task Icon -->
                            <img src="{{ asset('build/img/incheck.svg') }}" alt="Task Icon" style="width: 28px; height: 28px;">

                            <!-- Title and Time -->
                            <div style="flex-grow: 1;">
                                <div style="font-weight: 600; font-size: 14px; color: #2e3a59;">Task Title - Project Name</div>
                                <div style="font-size: 12px; color: #7f8ea3;">Set the Task ID #2 - to <span style="color: orange; font-weight: 600;">In Check</span></div>
                            </div>
                        </div>

                        <!-- User and Reason -->
                        <div style="display: flex; align-items: flex-start; gap: 8px; margin-top: 10px; background: #fff4f2; padding: 6px 10px; border-radius: 8px; font-size: 12px;width: fit-content;">
                            <!-- Avatar -->
                            <div style="min-width: 26px; height: 26px; border-radius: 50%; overflow: hidden;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <!-- Username and Reason -->
                            <div>
                                <span style="color: #2e3a59; font-weight: 600;">Username</span>
                                <span style="color: red; font-weight: 500;"> &nbsp; ! We will get the Reason here</span>
                            </div>
                        </div>

                        <!-- Time Top Right -->
                        <div style="position: absolute; top: 10px; right: 14px; font-size: 12px; color: #9ba3ae;">
                            1h
                        </div>

                        <!-- Red Dot Bottom Right -->
                        <div style="position: absolute; bottom: 26px; right: 14px; width: 10px; height: 10px; background: red; border-radius: 50%;"></div>
                    </div>
                    <!-- Indelayed -->
                    <div style="position: relative; background: #fff; border-radius: 12px; padding: 12px 14px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); font-family: sans-serif; margin: 10px 20px;">

                        <!-- Top Row: Icon + Title -->
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <!-- Task Icon -->
                            <img src="{{ asset('build/img/delayed.svg') }}" alt="Task Icon" style="width: 28px; height: 28px;">

                            <!-- Title and Time -->
                            <div style="flex-grow: 1;">
                                <div style="font-weight: 600; font-size: 14px; color: #2e3a59;">Task Title - Project Name</div>
                                <div style="font-size: 12px; color: #7f8ea3;">Set the Task ID #2 - to <span style="color: red; font-weight: 600;">In Delayed</span></div>
                            </div>
                        </div>

                        <!-- User and Reason -->
                        <div style="display: flex; align-items: flex-start; gap: 8px; margin-top: 10px; background: #fff4f2; padding: 6px 10px; border-radius: 8px; font-size: 12px;width: fit-content;">
                            <!-- Avatar -->
                            <div style="min-width: 26px; height: 26px; border-radius: 50%; overflow: hidden;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <!-- Username and Reason -->
                            <div>
                                <span style="color: #2e3a59; font-weight: 600;">Username</span>
                                <span style="color: red; font-weight: 500;"> &nbsp; ! We will get the Reason here</span>
                            </div>
                        </div>

                        <!-- Time Top Right -->
                        <div style="position: absolute; top: 10px; right: 14px; font-size: 12px; color: #9ba3ae;">
                            1h
                        </div>

                        <!-- Red Dot Bottom Right -->
                        <div style="position: absolute; bottom: 26px; right: 14px; width: 10px; height: 10px; background: red; border-radius: 50%;"></div>
                    </div>
                    <!-- progress -->
                    <div style="position: relative; background: #fff; border-radius: 12px; padding: 12px 14px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); font-family: sans-serif; margin: 10px 20px;">

                        <!-- Top Row: Icon + Title -->
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <!-- Task Icon -->
                            <img src="{{ asset('build/img/progress.svg') }}" alt="Task Icon" style="width: 28px; height: 28px;">

                            <!-- Title and Time -->
                            <div style="flex-grow: 1;">
                                <div style="font-weight: 600; font-size: 14px; color: #2e3a59;">Task Title - Project Name</div>
                                <div style="font-size: 12px; color: #7f8ea3;">Set the Task ID #2 - to <span style="color: red; font-weight: 600;">In Progress</span></div>
                            </div>
                        </div>

                        <!-- User and Reason -->
                        <div style="display: flex; align-items: flex-start; gap: 8px; margin-top: 10px; background: #fff4f2; padding: 6px 10px; border-radius: 8px; font-size: 12px;width: fit-content;">
                            <!-- Avatar -->
                            <div style="min-width: 26px; height: 26px; border-radius: 50%; overflow: hidden;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <!-- Username and Reason -->
                            <div>
                                <span style="color: #2e3a59; font-weight: 600;">Username</span>
                                <span style="color: red; font-weight: 500;"> &nbsp; ! We will get the Reason here</span>
                            </div>
                        </div>

                        <!-- Time Top Right -->
                        <div style="position: absolute; top: 10px; right: 14px; font-size: 12px; color: #9ba3ae;">
                            1h
                        </div>

                        <!-- Red Dot Bottom Right -->
                        <div style="position: absolute; bottom: 26px; right: 14px; width: 10px; height: 10px; background: red; border-radius: 50%;"></div>
                    </div>
                </div>
                <div id="tab-message" class="tab-content" style="display: none;">
                    <!-- Team chat -->
                    <div style="background-color: #fff; border-radius: 12px; padding: 20px; margin: 20px;">
                        <!-- Header -->
                        <div style="margin-bottom: 20px;">
                            <h6 style="font-weight: 600; color: #2e3a59; font-size: 16px; margin-bottom: 4px;">Team Chat</h6>
                            <small style="color: #7f8ea3;">Public Groups</small>
                        </div>
                        <!-- Scrollable Card Container -->
                        <div id="teamChat-cardScroller"
                            style="display: flex; gap: 16px; overflow-x: auto; scroll-behavior: smooth; padding-bottom: 16px; -ms-overflow-style: none; scrollbar-width: none;"
                            onscroll=" 
            var scroller = this; 
            var containerWidth = scroller.offsetWidth; 
            var index = Math.round(scroller.scrollLeft / containerWidth); 
            for(var i = 0; i < 3; i++) { 
                var dot = document.getElementById('teamChat-dot' + i); 
                dot.style.background = (i === index) ? '#00c469' : '#d4d4d4'; 
                dot.style.width = (i === index) ? '40px' : '20px'; 
            }">

                            <style>
                                #teamChat-cardScroller::-webkit-scrollbar {
                                    display: none;
                                }
                            </style>

                            <!-- CARD 1 -->
                            <div style="flex: 0 0 auto; width: 110px; border-radius: 16px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); text-align: center; height: 115px;">
                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="position: relative; margin-top: -20px;">
                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 2px solid limegreen; background: white;">
                                </div>
                                <div style="padding: 8px;">
                                    <h6 style="font-weight: 600; font-size: 11px; color: #000; margin: 0;">Team A</h6>
                                    <p style="margin: 0; color: #7f8ea3; font-size: 10px;">5 Users</p>
                                </div>
                            </div>

                            <!-- CARD 2 -->
                            <div style="flex: 0 0 auto; width: 110px; border-radius: 16px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); text-align: center; height: 115px;">
                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="position: relative; margin-top: -20px;">
                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 2px solid limegreen; background: white;">
                                </div>
                                <div style="padding: 8px;">
                                    <h6 style="font-weight: 600; font-size: 11px; color: #000; margin: 0;">Team B</h6>
                                    <p style="margin: 0; color: #7f8ea3; font-size: 10px;">7 Users</p>
                                </div>
                            </div>

                            <!-- CARD 3 -->
                            <div style="flex: 0 0 auto; width: 110px; border-radius: 16px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); text-align: center; height: 115px;">
                                <div style="position: relative; height: 50px; overflow: hidden; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                                    <img src="{{ URL::asset('/build/img/bgractangle.svg') }}" alt="Background"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="position: relative; margin-top: -20px;">
                                    <img src="{{ URL::asset('/build/img/profile.svg') }}" alt="Profile"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 2px solid gold; background: white;">
                                </div>
                                <div style="padding: 8px;">
                                    <h6 style="font-weight: 600; font-size: 11px; color: #000; margin: 0;">Team C</h6>
                                    <p style="margin: 0; color: #7f8ea3; font-size: 10px;">9 Users</p>
                                </div>
                            </div>
                            <!-- more cards if needed -->
                        </div>

                        <!-- Dot Indicator -->
                        <div style="display: flex; justify-content: center; gap: 10px; margin-top: 10px;">
                            <div id="teamChat-dot0"
                                style="width: 40px; height: 5px; border-radius: 8px; background: #00c469; cursor: pointer;"
                                onclick=" 
                var scroller=document.getElementById('teamChat-cardScroller'); 
                var containerWidth=scroller.offsetWidth; 
                scroller.scrollTo({left:0*containerWidth,behavior:'smooth'}); 
                for(var i=0; i<3; i++) { 
                    var dot=document.getElementById('teamChat-dot'+i);  
                    dot.style.background=(i===0)?'#00c469':'#d4d4d4';  
                    dot.style.width=(i===0)?'40px':'20px'; 
                }">
                            </div>
                            <div id="teamChat-dot1"
                                style="width: 20px; height: 5px; border-radius: 8px; background: #d4d4d4; cursor: pointer;"
                                onclick=" 
                var scroller=document.getElementById('teamChat-cardScroller'); 
                var containerWidth=scroller.offsetWidth; 
                scroller.scrollTo({left:1*containerWidth,behavior:'smooth'}); 
                for(var i=0; i<3; i++) { 
                    var dot=document.getElementById('teamChat-dot'+i); 
                    dot.style.background=(i===1)?'#00c469':'#d4d4d4'; 
                    dot.style.width=(i===1)?'40px':'20px'; 
                }">
                            </div>
                            <div id="teamChat-dot2"
                                style="width: 20px; height: 5px; border-radius: 8px; background: #d4d4d4; cursor: pointer;"
                                onclick=" 
                var scroller=document.getElementById('teamChat-cardScroller'); 
                var containerWidth=scroller.offsetWidth; 
                scroller.scrollTo({left:2*containerWidth,behavior:'smooth'}); 
                for(var i=0; i<3; i++) { 
                    var dot=document.getElementById('teamChat-dot'+i); 
                    dot.style.background=(i===2)?'#00c469':'#d4d4d4'; 
                    dot.style.width=(i===2)?'40px':'20px'; 
                }">
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div style="background: #fff; border-radius: 12px; padding: 12px 16px; margin: 20px; position: relative;margin-bottom: 0px;">

                        <!-- Header -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2px;">
                            <span style="font-weight: 600; color: #2e3a59; font-size: 16px;">Member Online</span>
                            <i class="bi bi-pin-fill" style="color: red; font-size: 18px; transform: rotate(45deg);"></i>
                        </div>

                        <!-- Avatars Row -->
                        <div style="display: flex; gap: 12px;">

                            <!-- Avatar 1 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px;   padding: 5px;">

                            </div>

                            <!-- Avatar 2 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px; padding: 5px;">

                            </div>

                            <!-- Avatar 3 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px;  padding: 5px;">

                            </div>

                            <!-- Avatar 4 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px;  padding: 5px;">

                            </div>

                            <!-- Avatar 5 -->
                            <div style="position: relative;">
                                <img src="{{ asset('build/img/avatar.svg') }}" alt="Avatar" style="width: 50px; height: 50px;  padding: 5px;">

                            </div>

                        </div>
                    </div>
                    <!-- Online user -->

                    <!-- /Online Contacts -->

                    <div class="sidebar-body chat-body" id="chatsidebar">

                        <!-- Left Chat Title -->

                        <!-- /Left Chat Title -->
                        <div class="tab-content" id="innerTabContent">
                            <div class="tab-pane fade show active" id="all-chats" role="tabpanel" aria-labelledby="all-chats-tab">
                                <div class="chat-users-wrap">
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Mark Villiams</h6>
                                                    <p><span class="animate-typing">is typing
                                                            <span class="dot"></span>
                                                            <span class="dot"></span>
                                                            <span class="dot"></span>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">12</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Sarika Jain</h6>
                                                    <p>Do you know which...</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">06:12 AM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Clyde Smith</h6>
                                                    <p>Haha oh man ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">03:15 AM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">55</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg bg-pink avatar-rounded me-2">
                                                <span class="avatar-title fs-14 fw-medium">AG</span>
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Amfr_boys_Group</h6>
                                                    <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Yesterday</span>
                                                    <div class="chat-pin">
                                                        <span class="count-message fs-12 fw-semibold">5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Carla Jenkins</h6>
                                                    <p class="text-success"><i class="ti ti-video-plus me-2"></i>Incoming Video Call</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Sunday</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Federico Wells</h6>
                                                    <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Wednesday</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">12</span>
                                                        <i class="bx bx-check-double"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Edward Lietz</h6>
                                                    <p><i class="ti ti-file me-2"></i>Document</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg bg-skyblue online avatar-rounded me-2">
                                                <span class="avatar-title fs-14 fw-medium">GU</span>
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Gustov_family</h6>
                                                    <p>Please Check<span class="text-primary ms-1">@rev</span></p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">24 Jul 2024</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-07.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Estell Gibson</h6>
                                                    <p class="text-danger"><i class="ti ti-video-off me-2"></i>Missed Video Call</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-08.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Sharon Ford</h6>
                                                    <p>Hi How are you ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-09.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Thomas Rethman</h6>
                                                    <p>Do you know which...</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Wilbur Martinez</h6>
                                                    <p>Haha oh man ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-11.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Danielle Baker</h6>
                                                    <p><i class="ti ti-map-pin-plus me-2"></i>Location</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-13.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Morkel Jerrin</h6>
                                                    <p><i class="ti ti-video me-2"></i>Video</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="favourites-chat" role="tabpanel" aria-labelledby="favourites-chat-tab">
                                <div class="chat-users-wrap">

                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Clyde Smith</h6>
                                                    <p>Haha oh man ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">03:15 AM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">55</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg bg-pink avatar-rounded me-2">
                                                <span class="avatar-title fs-14 fw-medium">AG</span>
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Amfr_boys_Group</h6>
                                                    <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Yesterday</span>
                                                    <div class="chat-pin">
                                                        <span class="count-message fs-12 fw-semibold">5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Carla Jenkins</h6>
                                                    <p class="text-success"><i class="ti ti-video-plus me-2"></i>Incoming Video Call</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Sunday</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Federico Wells</h6>
                                                    <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Wednesday</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">12</span>
                                                        <i class="bx bx-check-double"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Mark Villiamss</h6>
                                                    <p><span class="animate-typing">is typing
                                                            <span class="dot"></span>
                                                            <span class="dot"></span>
                                                            <span class="dot"></span>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">12</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Sarika Jain</h6>
                                                    <p>Do you know which...</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">06:12 AM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Edward Lietz</h6>
                                                    <p><i class="ti ti-file me-2"></i>Document</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg bg-skyblue online avatar-rounded me-2">
                                                <span class="avatar-title fs-14 fw-medium">GU</span>
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Gustov_family</h6>
                                                    <p>Please Check<span class="text-primary ms-1">@rev</span></p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">24 Jul 2024</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-07.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Estell Gibson</h6>
                                                    <p class="text-danger"><i class="ti ti-video-off me-2"></i>Missed Video Call</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-08.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Sharon Ford</h6>
                                                    <p>Hi How are you ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-09.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Thomas Rethman</h6>
                                                    <p>Do you know which...</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Wilbur Martinez</h6>
                                                    <p>Haha oh man ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-11.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Danielle Baker</h6>
                                                    <p><i class="ti ti-map-pin-plus me-2"></i>Location</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-13.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Morkel Jerrin</h6>
                                                    <p><i class="ti ti-video me-2"></i>Video</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pinned-chats" role="tabpanel" aria-labelledby="pinned-chats-tab">
                                <div class="chat-users-wrap">
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Carla Jenkins</h6>
                                                    <p class="text-success"><i class="ti ti-video-plus me-2"></i>Incoming Video Call</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Sunday</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Federico Wells</h6>
                                                    <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Wednesday</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">12</span>
                                                        <i class="bx bx-check-double"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Clyde Smith</h6>
                                                    <p>Haha oh man ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">03:15 AM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">55</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg bg-pink avatar-rounded me-2">
                                                <span class="avatar-title fs-14 fw-medium">AG</span>
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Amfr_boys_Group</h6>
                                                    <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Yesterday</span>
                                                    <div class="chat-pin">
                                                        <span class="count-message fs-12 fw-semibold">5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Mark Villiamss</h6>
                                                    <p><span class="animate-typing">is typing
                                                            <span class="dot"></span>
                                                            <span class="dot"></span>
                                                            <span class="dot"></span>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">12</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Sarika Jain</h6>
                                                    <p>Do you know which...</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">06:12 AM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Edward Lietz</h6>
                                                    <p><i class="ti ti-file me-2"></i>Document</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg bg-skyblue online avatar-rounded me-2">
                                                <span class="avatar-title fs-14 fw-medium">GU</span>
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Gustov_family</h6>
                                                    <p>Please Check<span class="text-primary ms-1">@rev</span></p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">24 Jul 2024</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-07.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Estell Gibson</h6>
                                                    <p class="text-danger"><i class="ti ti-video-off me-2"></i>Missed Video Call</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-08.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Sharon Ford</h6>
                                                    <p>Hi How are you ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-09.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Thomas Rethman</h6>
                                                    <p>Do you know which...</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Wilbur Martinez</h6>
                                                    <p>Haha oh man ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-11.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Danielle Baker</h6>
                                                    <p><i class="ti ti-map-pin-plus me-2"></i>Location</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-13.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Morkel Jerrin</h6>
                                                    <p><i class="ti ti-video me-2"></i>Video</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="archive-chats" role="tabpanel" aria-labelledby="archive-chats-tab">
                                <div class="chat-users-wrap">
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Clyde Smith</h6>
                                                    <p>Haha oh man ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">03:15 AM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">55</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg bg-pink avatar-rounded me-2">
                                                <span class="avatar-title fs-14 fw-medium">AG</span>
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Amfr_boys_Group</h6>
                                                    <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Yesterday</span>
                                                    <div class="chat-pin">
                                                        <span class="count-message fs-12 fw-semibold">5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Carla Jenkins</h6>
                                                    <p class="text-success"><i class="ti ti-video-plus me-2"></i>Incoming Video Call</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Sunday</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Federico Wells</h6>
                                                    <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Wednesday</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">12</span>
                                                        <i class="bx bx-check-double"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Mark Villiamss</h6>
                                                    <p><span class="animate-typing">is typing
                                                            <span class="dot"></span>
                                                            <span class="dot"></span>
                                                            <span class="dot"></span>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">12</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Sarika Jain</h6>
                                                    <p>Do you know which...</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">06:12 AM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Edward Lietz</h6>
                                                    <p><i class="ti ti-file me-2"></i>Document</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg bg-skyblue online avatar-rounded me-2">
                                                <span class="avatar-title fs-14 fw-medium">GU</span>
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Gustov_family</h6>
                                                    <p>Please Check<span class="text-primary ms-1">@rev</span></p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">24 Jul 2024</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-07.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Estell Gibson</h6>
                                                    <p class="text-danger"><i class="ti ti-video-off me-2"></i>Missed Video Call</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-08.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Sharon Ford</h6>
                                                    <p>Hi How are you ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-09.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Thomas Rethman</h6>
                                                    <p>Do you know which...</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Wilbur Martinez</h6>
                                                    <p>Haha oh man ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-11.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Danielle Baker</h6>
                                                    <p><i class="ti ti-map-pin-plus me-2"></i>Location</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-13.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Morkel Jerrin</h6>
                                                    <p><i class="ti ti-video me-2"></i>Video</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="trash-chats" role="tabpanel" aria-labelledby="trash-chats-tab">
                                <div class="chat-users-wrap">
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Sarika Jain</h6>
                                                    <p>Do you know which...</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">06:12 AM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Clyde Smith</h6>
                                                    <p>Haha oh man ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">03:15 AM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">55</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle border border-warning border-2" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Mark Villiamss</h6>
                                                    <p><span class="animate-typing">is typing
                                                            <span class="dot"></span>
                                                            <span class="dot"></span>
                                                            <span class="dot"></span>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">12</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg bg-pink avatar-rounded me-2">
                                                <span class="avatar-title fs-14 fw-medium">AG</span>
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Amfr_boys_Group</h6>
                                                    <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Yesterday</span>
                                                    <div class="chat-pin">
                                                        <span class="count-message fs-12 fw-semibold">5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Carla Jenkins</h6>
                                                    <p class="text-success"><i class="ti ti-video-plus me-2"></i>Incoming Video Call</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Sunday</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Federico Wells</h6>
                                                    <p><i class="ti ti-photo me-2"></i>Photo</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">Wednesday</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">12</span>
                                                        <i class="bx bx-check-double"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Edward Lietz</h6>
                                                    <p><i class="ti ti-file me-2"></i>Document</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg bg-skyblue online avatar-rounded me-2">
                                                <span class="avatar-title fs-14 fw-medium">GU</span>
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Gustov_family</h6>
                                                    <p>Please Check<span class="text-primary ms-1">@rev</span></p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">24 Jul 2024</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-07.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Estell Gibson</h6>
                                                    <p class="text-danger"><i class="ti ti-video-off me-2"></i>Missed Video Call</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-08.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Sharon Ford</h6>
                                                    <p>Hi How are you ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-09.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Thomas Rethman</h6>
                                                    <p>Do you know which...</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-10.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Wilbur Martinez</h6>
                                                    <p>Haha oh man ðŸ”¥</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-pin me-2"></i>
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-11.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Danielle Baker</h6>
                                                    <p><i class="ti ti-map-pin-plus me-2"></i>Location</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <a href="{{url('chat')}}" class="chat-user-list">
                                            <div class="avatar avatar-lg online me-2">
                                                <img src="{{URL::asset('/build/img/profiles/avatar-13.jpg')}}" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="chat-user-info">
                                                <div class="chat-user-msg">
                                                    <h6>Morkel Jerrin</h6>
                                                    <p><i class="ti ti-video me-2"></i>Video</p>
                                                </div>
                                                <div class="chat-user-time">
                                                    <span class="time">02:40 PM</span>
                                                    <div class="chat-pin">
                                                        <i class="ti ti-heart-filled text-warning me-2"></i>
                                                        <span class="count-message fs-12 fw-semibold">25</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="chat-dropdown">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-box-align-right me-2"></i>Archive Chat</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-heart me-2"></i>Mark as Favourite</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-check me-2"></i>Mark as Unread</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="ti ti-pinned me-2"></i>Pin Chats</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete-chat"><i class="ti ti-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <!-- / Chats sidebar -->

        </div>
    </div>
</div>

<script>
    function showTab(tabName) {
        const tabs = ['layers', 'bell', 'notifi', 'message'];

        tabs.forEach(name => {
            // Show/hide content
            document.getElementById(`tab-${name}`).style.display = (name === tabName) ? 'block' : 'none';

            // Add/remove 'selected' class
            const icon = document.getElementById(`icon-${name}`);
            if (icon) {
                icon.classList.toggle('selected', name === tabName);
            }
        });
    }
</script>