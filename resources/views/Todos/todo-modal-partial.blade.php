<!-- Todo Modal -->
<div class="modal fade" id="todomodel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 0 20px rgba(0,0,0,0.05); position: relative;">

            <form id="todoForm" action="{{ route('todos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="todo_id" id="todo_id">
                <input type="hidden" name="start_date" id="startDateHidden">
                <input type="hidden" name="start_time" id="startTimeHidden">
                <input type="hidden" name="end_time" id="endTimeHidden">
                <input type="hidden" name="end_date" id="endDateHidden">
                <input type="hidden" name="is_private" id="isPrivateHidden" value="0">
                <input type="hidden" name="todo_visibility" id="todo_visibility">
                <input type="hidden" name="selected_user" id="selected_user">
                <input type="hidden" name="priority" id="priorityHidden">
                <input type="hidden" name="reminder" id="reminderHidden">
                <input type="hidden" name="todaytime" id="timeHidden">
                <input type="hidden" name="todo_type" id="todo_type">

                <div class="modal-body p-4" style="background-color: white;">
                    <h5 style="font-weight: 600; color: #1e293b;">
                        <span id="todo_heading">Create new ToDo</span>
                        <div style="padding:8px 5px; background-color: #F2F2F2; border-radius: 10px; float:right; display: flex; gap: 8px; margin-top:10px;">
                            <button type="button" id="btnShared"
                                onclick="
                                    this.style.backgroundColor='#22c55e';
                                    this.style.color='white';
                                    document.getElementById('btnPrivate').style.backgroundColor='transparent';
                                    document.getElementById('btnPrivate').style.color='#64748b';
                                    document.getElementById('todo_visibility').value='shared';
                                    document.getElementById('isPrivateHidden').value='0';
                                    if (window.selectedUsers) {
                                        window.selectedUsers = [];
                                    }
                                "
                                style="border: none; background-color: transparent; color: #64748b; padding: 4px 10px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                Shared ToDo's
                            </button>

                            <button type="button" id="btnPrivate"
                                onclick="
                                    this.style.backgroundColor='#22c55e';
                                    this.style.color='white';
                                    document.getElementById('btnShared').style.backgroundColor='transparent';
                                    document.getElementById('btnShared').style.color='#64748b';
                                    document.getElementById('todo_visibility').value='private';
                                    document.getElementById('isPrivateHidden').value='1';
                                    document.querySelectorAll('.user_div.user_active').forEach((el, index) => {
                                        if (index > 0) {
                                            el.classList.remove('user_active');
                                            let userId = el.getAttribute('data-user-id');
                                            let option = document.getElementById('members');
                                            if (option) {
                                                let opt = option.querySelector(`option[value='${userId}']`);
                                                if (opt) opt.selected = false;
                                            }
                                        }
                                    });
                                    if (window.selectedUsers && window.selectedUsers.length > 1) {
                                        window.selectedUsers = window.selectedUsers.slice(0, 1);
                                        document.getElementById('selected_user').value = window.selectedUsers.join(',');
                                    }
                                "
                                style="border: none; background-color: transparent; color: #64748b; padding: 4px 10px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                Private ToDo's
                            </button>
                        </div>
                    </h5>
                    <p style="color: #64748b; font-size: 14px;">Manage your Time</p>

                    <!-- shared section starts -->
                    <div class="mb-3" id="selectUsersBox" style="background-color: #f9f9fb; border-radius:10px; padding:16px;">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <select id="select_project" class="form-control selection">
                                    <option value="">Select Project</option>
                                    @foreach($projects ?? [] as $project)
                                        <option value="{{ $project->_id }}">{{ $project->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select id="select_team" class="form-control selection">
                                    <option value="">Select Team</option>
                                    @foreach($teams ?? [] as $team)
                                        <option value="{{ $team->_id }}">{{ $team->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <h5>Select Users</h5>
                        <p>Project - Team</p>

                        <div id="userScroller" class="user-slider-wrapper" style="display: flex; gap: 16px; overflow-x: auto; scroll-behavior: smooth; padding-bottom: 16px; -ms-overflow-style: none; scrollbar-width: none;">
                            <style>
                                #userScroller::-webkit-scrollbar {
                                    display: none;
                                }
                            </style>

                            @foreach($users as $cuser)
                                <div class="user_div" style="flex: 0 0 auto; width: 110px; border-radius: 16px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.05); text-align: center; height: 135px;" 
                                    id="user_{{$cuser->_id}}" 
                                    data-user-id="{{$cuser->_id}}">
                                    <div class="invit-img">
                                        @php
                                            $img = $cuser->image
                                                ? asset($cuser->image)
                                                : asset('build/img/profile.svg');
                                            $img = str_replace('admin.onlinesystems.info', 'team.onlinesystems.info', $img);
                                        @endphp
                                        <img src="{{ $img }}" alt="{{$cuser->name}}" />
                                    </div>
                                    <div class="invit-txt">{{$cuser->name}}</div>
                                </div>
                            @endforeach
                        </div>
                        <div style="display: flex; justify-content: center; gap: 10px; margin-top: 10px;">
                            <div id="dot_user0" style="width: 40px; height: 5px; border-radius: 8px; background: #00c469; cursor: pointer;"></div>
                            <div id="dot_user1" style="width: 20px; height: 5px; border-radius: 8px; background: #d4d4d4; cursor: pointer;"></div>
                            <div id="dot_user2" style="width: 20px; height: 5px; border-radius: 8px; background: #d4d4d4; cursor: pointer;"></div>
                        </div>
                    </div>
                    
                    <!-- Hidden members select for form submission -->
                    <select id="members" multiple name="members[]" style="display: none;">
                        @foreach($users ?? [] as $cuser)
                            <option value="{{$cuser->_id}}">{{$cuser->name}}</option>
                        @endforeach
                    </select>

                    <!-- File upload section -->
                    <div class="" style="background-color:#f7f9fc; border-radius: 12px; padding: 15px; margin-bottom:5px;">
                        <div class="col-md-12">
                            <div id="createPdfList" class="d-flex gap-2 flex-wrap">
                                <div class="pdf-add-tile d-flex align-items-center justify-content-center text-center"
                                    style="width: 160px; height: 60px; border: 1px dashed #cfd3d9; border-radius: 10px; cursor: pointer; background:#fff;"
                                    onclick="createAddPdfFile()">
                                    <div style="font-size: 22px; color: #a0a4ab; line-height: 1;">+</div>
                                </div>
                            </div>
                            <div id="createPdfInputs" style="display:none;"></div>
                        </div>
                    </div>

                    <!-- Today/Scheduled Toggle + Date/Time Section -->
                    <div style="background-color: #f9f9fb; border-radius:10px; padding:8px; margin-bottom:10px;">
                        <div style="margin-bottom: 6px; margin-top: 4px;">
                            <div style="border-radius: 10px; padding: 6px; gap: 8px; background:#fff;">
                                <button class="btnToday" id="btnToday" type="button"
                                    onclick="
                                        this.style.backgroundColor='#22c55e';
                                        this.style.color='white';
                                        document.getElementById('btnScheduled').style.backgroundColor='transparent';
                                        document.getElementById('btnScheduled').style.color='#64748b';
                                        document.getElementById('timeRow').classList.add('justify-content-center1');
                                        document.getElementById('todo_type').value='today';
                                    "
                                    style="border: none; background-color: transparent; color: #64748b; padding: 2px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Today ToDo's
                                </button>

                                <button class="btnScheduled" id="btnScheduled" type="button"
                                    onclick="
                                        this.style.backgroundColor='#22c55e';
                                        this.style.color='white';
                                        document.getElementById('btnToday').style.backgroundColor='transparent';
                                        document.getElementById('btnToday').style.color='#64748b';
                                        document.getElementById('timeRow').classList.remove('justify-content-center');
                                        document.getElementById('todo_type').value='scheduled';
                                    "
                                    style="border: none; background-color: transparent; color: #64748b; padding: 2px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    Scheduled ToDo's
                                </button>
                            </div>
                        </div>
                        
                        <div class="gap-2" style="padding:8px;">
                            <div><b>Delivery Time</b></div>
                            <p>Time to deliver the work</p>
                        </div>
                       
                        <!-- Today time selection -->
                        <div class="d-flex1 gap-2 mb-3 bg-white" id="timeToday" style="padding: 8px;">
                            <button type="button" class="time-btn time-btn-2" data-value="2">2 Hour</button>
                            <button type="button" class="time-btn time-btn-3" data-value="3">3 Hour</button>
                            <button type="button" class="time-btn time-btn-6" data-value="6">6 Hour</button>
                            <button type="button" class="time-btn time-btn-9" data-value="9">9 Hour</button>
                            <button type="button" class="time-btn time-btn-12" data-value="12">12 Hour</button>
                        </div>
                         
                        <!-- Date & Time Inputs for Scheduled -->
                        <div class="row g-2 align-items-center1 mb-3 justify-content-center1" id="timeRow" style="padding: 8px; display: none;">
                            <div class="col-md-4" id="startDateField" style="position: relative;">
                                <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
                                    <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Start Date</div>
                                    <div id="dateDisplay" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY</div>
                                    <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                        <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                            onclick="document.getElementById('dateInput').showPicker()"
                                            style="width: 20px; height: 20px; cursor: pointer;" />
                                        <input type="date" id="dateInput"
                                            min="{{ date('Y-m-d') }}"  
                                            onchange="
                                                let d = new Date(this.value);
                                                if (this.value) {
                                                    document.getElementById('dateDisplay').innerText = ('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear();
                                                    let endInput = document.getElementById('enddateInput');
                                                    endInput.min = this.value;
                                                    if (endInput.value && new Date(endInput.value) < new Date(this.value)) {
                                                        endInput.value = '';
                                                        document.getElementById('enddateDisplay').innerText = 'DD:MM:YYYY';
                                                    }
                                                }
                                            "
                                            style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" id="endDateField" style="position: relative;">
                                <div style="background-color: #fff; border-radius: 12px; padding: 2px 16px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
                                    <div style="font-weight: 600; font-size: 14px; color: #7d7f85;">Deliver Date</div>
                                    <div id="enddateDisplay" style="font-size: 13px; color: #a0a4ab;">DD:MM:YYYY</div>
                                    <div style="position: absolute; top: 50%; right: 16px; transform: translateY(-50%);">
                                        <img src="{{ URL::asset('/build/img/timeicon.svg') }}"
                                            onclick="document.getElementById('enddateInput').showPicker()"
                                            style="width: 20px; height: 20px; cursor: pointer;" />
                                        <input type="date" id="enddateInput"
                                            min="{{ date('Y-m-d') }}" 
                                            onchange="
                                                let d = new Date(this.value);
                                                if (this.value) {
                                                    document.getElementById('enddateDisplay').innerText = ('0'+d.getDate()).slice(-2)+':' + ('0'+(d.getMonth()+1)).slice(-2)+':'+d.getFullYear();
                                                }
                                            "
                                            style="opacity:0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" style="position: relative;">
                                <div style="background-color: #fff; border-radius: 12px; padding: 2px 10px; width: 100%; border: 1px solid #e0e0e0; height: 45px; display: flex; flex-direction: column; justify-content: center;">
                                    <select name="end_time" id="endTimeSelect">
                                        <option value="">Deliver Time</option>
                                        @for ($h = 0; $h < 24; $h++)
                                            @php $time = sprintf("%02d:00", $h); @endphp
                                            <option value="{{ $time }}">{{ $time }}</option>
                                            @php $time = sprintf("%02d:30", $h); @endphp
                                            <option value="{{ $time }}">{{ $time }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ToDo Details -->
                    <div style="background-color: #f9f9fb; border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                        <div class="row">
                            <div style="margin-bottom: 12px;" class="col-md-6">
                                <p style="font-weight: 600; font-size: 14px; color: #1e293b; margin: 0;">ToDo Details</p>
                                <p style="font-size: 12px; color: #64748b; margin: 0;">Manage your time</p>
                            </div>
                            <div class="col-md-6">
                                <p style="font-size: 12px; font-weight: 600; color: #334155;margin-bottom: 2px;">Todo Priority</p>
                                <p style="font-size: 11px; color: #6b7280;margin-bottom: 8px;">Set the priority of the Todo</p>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <input id="todo_name" name="title" required type="text" class="form-control" placeholder="ToDo Title"
                                    style="font-size: 13px; background-color: white; border-radius: 8px;">
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex1 gap-2 bg-white">
                                    <button class="priority active1" type="button" id="priorityLow">Low</button>
                                    <button class="priority" type="button" id="priorityMiddle">Middle</button>
                                    <button class="priority" type="button" id="priorityHigh">High</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-2 mt-2" id="sectionsWrapper">
                            <div class="col-md-12 d-flex align-items-center section-item">
                                <input name="sections[]" type="text" class="form-control" placeholder="Section Description"
                                    style="font-size: 13px; background-color: white; border-radius: 8px;">
                                <button type="button" class="btn btn-plus btn-sm ms-2 add-btn"><span>+</span></button>
                            </div>
                        </div>
                    </div>

                    <!-- Priority & Reminder -->
                    <div class="p-3 mb-3 rounded" style="background-color: #f9f9fb; box-shadow: inset 0 0 2px rgba(0,0,0,0.05);">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p style="font-size: 12px; font-weight: 600; color: #334155;margin-bottom: 2px;">Expired Reminder</p>
                                <p style="font-size: 11px; color: #6b7280;margin-bottom: 8px;">Set a reminder before expired</p>
                                <div class="d-flex gap-2">
                                    <div class="d-flex" style="background:#fff; border-radius: 5px; gap: 3px; padding: 5px;">
                                        <button type="button" class="reminder-btn rem-30" data-value="30">30 Min</button>
                                        <button type="button" class="reminder-btn rem-60" data-value="60">60 Min</button>
                                        <button type="button" class="reminder-btn rem-120" data-value="120">2 Hour</button>
                                        <button type="button" class="reminder-btn rem-180" data-value="180">3 Hour</button>
                                        <button type="button" class="reminder-btn rem-240" data-value="240">4 Hour</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center" style="margin-top: 15px;">
                        <button class="btn" type="button" data-bs-dismiss="modal"
                            style="background-color: #f7f7f7; color:#64748b; border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                            Close
                        </button>
                        <button id="saveBtn" type="button" class="btn" 
                            style="background-color: #f7f7f7; color:#64748b; border-radius: 8px; padding: 6px 20px; font-size: 14px; font-weight: 500;">
                            Save & Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
