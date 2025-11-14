<style>
    .dark-icon {
 content: url('/build/img/Moon Black.svg');
  transition: 0.3s ease;
}

.dark-mode-toggle:hover .dark-icon {
 content: url('/build/img/Moon White.svg');
}

/* Ensure moon and logout icons always show black icon by default (not white like active items) */
#dark-mode-toggle.task-icon-link .icon-white,
#logout-link.task-icon-link .icon-white {
    opacity: 0 !important;
}

#dark-mode-toggle.task-icon-link .icon-black,
#logout-link.task-icon-link .icon-black {
    opacity: 1 !important;
}

/* Show white icon on hover only */
#dark-mode-toggle.task-icon-link:hover .icon-white,
#logout-link.task-icon-link:hover .icon-white {
    opacity: 1 !important;
}

#dark-mode-toggle.task-icon-link:hover .icon-black,
#logout-link.task-icon-link:hover .icon-black {
    opacity: 0 !important;
}

/* Prevent active state styling on moon and logout */
#dark-mode-toggle.task-icon-link.active,
#logout-link.task-icon-link.active {
    background-color: transparent !important;
}

/* Make profile-menu action buttons match main-menu sizing/active styles */
.sidebar-menu .profile-menu ul li a {
    width: 50px;
    height: 50px;
    display: flex;
    display: -webkit-flex;
    align-items: center;
    -webkit-align-items: center;
    justify-content: center;
    -webkit-justify-content: center;
    border-radius: 8px;
    color: #141B27;
    font-size: 22px;
}
.sidebar-menu .profile-menu ul li a.active,
.sidebar-menu .profile-menu ul li a:hover {
    background-color: #6338F6;
    color: #FFF;
}

</style>
@php
$setting = App\Models\Setting::first();

@endphp
 <div class="sidebar-menu">
       <div class="logo"> 
           <a href="{{ url('/home') }}" class="logo-normal">
               <img src="{{ $setting->app_logo ?? URL::asset('/build/img/AI-Logo.svg') }}" alt="Logo" style="max-width: 70% !important;">
           </a>
       </div>
       <div class="menu-wrap">
           <div class="main-menu">
               <ul class="nav">
                   {{-- <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="AI" data-bs-custom-class="tooltip-primary">
                       <a href="{{ route('chat-ai') }}" class="nav-link task-icon-link {{ request()->is('Ai') ? 'active' : '' }}">
                           <img src="{{ asset('/build/img/AI-White.svg') }}" alt="AI Icon" class="icon-white">
                           <img src="{{ asset('/build/img/AI-Black.svg') }}" alt="AI Icon" class="icon-black">
                       </a>
                   </li> --}}

                   <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Chats" data-bs-custom-class="tooltip-primary">
                       <a href="{{ route('chat.index') }}" class="nav-link task-icon-link {{ request()->is('chat') ? 'active' : '' }}">
                           <img src="{{ asset('/build/img/Chat-White.svg') }}" alt="White Icon" class="icon-white">
                           <img src="{{ asset('/build/img/Chat-Black.svg') }}" alt="Black Icon" class="icon-black">
                       </a>
                   </li>

                   <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Project" data-bs-custom-class="tooltip-primary">
                       <a href="{{ route('chat-project') }}" class="nav-link task-icon-link {{ request()->is('project') ? 'active' : '' }}">
                           <img src="{{ asset('/build/img/Project-White.svg') }}" alt="Project White" class="icon-white">
                           <img src="{{ asset('/build/img/Project-Black.svg') }}" alt="Project Black" class="icon-black">
                       </a>
                   </li>
                   
                   <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Ticket" data-bs-custom-class="tooltip-primary">
                       <a href="{{ route('chat-ticket') }}" class="nav-link task-icon-link {{ request()->is('ticket') ? 'active' : '' }}">
                           <img src="{{ asset('/build/img/ticket_icon_white.svg') }}" alt="Task White" class="icon-white">
                           <img src="{{ asset('/build/img/ticket_icon_black.svg') }}" alt="Task Black" class="icon-black">
                       </a>
                   </li>
                     <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Task" data-bs-custom-class="tooltip-primary">
                       <a href="{{ route('chat-task') }}" class="nav-link task-icon-link {{ request()->is('tasks') ? 'active' : '' }}">
                           <img src="{{ asset('/build/img/Tasks_icon_white.svg') }}" alt="Task White" class="icon-white">
                           <img src="{{ asset('/build/img/Tasks_icon_Balck.svg') }}" alt="Task Black" class="icon-black">
                       </a>
                   </li>
                     <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Teams" data-bs-custom-class="tooltip-primary">
                       <a href="{{ route('chat-team') }}" class="nav-link task-icon-link {{ request()->is('teams') ? 'active' : '' }}">
                           <img src="{{ asset('/build/img/Teams_Icon_White.svg') }}" alt="User White" class="icon-white">
                           <img src="{{ asset('/build/img/Teams_Icon_Black.svg') }}" alt="User Black" class="icon-black">
                       </a>
                   </li>
                     <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="meeting" data-bs-custom-class="tooltip-primary">
                       <a href="{{ route('chat-meetings') }}" class="nav-link task-icon-link {{ request()->is('meetings') ? 'active' : '' }}">
                           <img src="{{ asset('/build/img/Meeting - White.svg') }}" alt="White Icon" class="icon-white">
                           <img src="{{ asset('/build/img/Meeting - Black.svg') }}" alt="Black Icon" class="icon-black">
                       </a>
                   </li>
                     <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Todo" data-bs-custom-class="tooltip-primary">
                       <a href="{{ route('chat-groups') }}" class="nav-link task-icon-link {{ request()->is('todos') ? 'active' : '' }}">
                           <img src="{{ asset('/build/img/ToDo - White.svg') }}" alt="todo White" class="icon-white">
                           <img src="{{ asset('/build/img/ToDo - Black.svg') }}" alt="todo Black" class="icon-black">
                       </a>
                   </li>
                      <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Users" data-bs-custom-class="tooltip-primary">
                       <a href="{{ route('chat-users') }}" class="nav-link task-icon-link {{ request()->is('users') ? 'active' : '' }}">
                           <img src="{{ asset('/build/img/Users-White.svg') }}" alt="User White" class="icon-white">
                           <img src="{{ asset('/build/img/Users-Black.svg') }}" alt="User Black" class="icon-black">
                       </a>
                   </li>
                  
                   {{-- <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="API" data-bs-custom-class="tooltip-primary">
                       <a href="{{ route('chat-api') }}" class="nav-link task-icon-link {{ request()->is('Apis') ? 'active' : '' }}">
                           <img src="{{ asset('/build/img/API-White.svg') }}" alt="API White" class="icon-white">
                           <img src="{{ asset('/build/img/API-Black.svg') }}" alt="API Black" class="icon-black">
                       </a>
                   </li>


                   <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Library" data-bs-custom-class="tooltip-primary">
                       <a href="{{ route('chat-library') }}" class="nav-link task-icon-link {{ request()->is('library') ? 'active' : '' }}">
                           <img src="{{ asset('/build/img/Library-White.svg') }}" alt="Library White" class="icon-white">
                           <img src="{{ asset('/build/img/Library-Black.svg') }}" alt="Library Black" class="icon-black">
                       </a>
                   </li> --}}
               </ul>
           </div>

           <div class="profile-menu">
               <ul>
                    <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Settings" data-bs-custom-class="tooltip-primary">
                        <a href="{{ route('settings') }}" class="nav-link task-icon-link {{ request()->is('settings') ? 'active' : '' }}">
                            <img src="{{ asset('/build/img/Settings-White.svg') }}" alt="Settings White" class="icon-white">
                            <img src="{{ asset('/build/img/Settings-Balck.svg') }}" alt="Settings Black" class="icon-black">
                        </a>
                    </li>

                    <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dark Mode" data-bs-custom-class="tooltip-primary">
                        <a href="#" id="dark-mode-toggle" class="nav-link task-icon-link">
                            <img src="{{ asset('/build/img/Moon White.svg') }}" alt="Moon White" class="icon-white">
                            <img src="{{ asset('/build/img/Moon Black.svg') }}" alt="Moon Black" class="icon-black">
                        </a>
                    </li>

                    <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Logout" data-bs-custom-class="tooltip-primary">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" id="logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link task-icon-link">
                            <img src="{{ asset('/build/img/exit.svg') }}" alt="Logout White" class="icon-white">
                            <img src="{{ asset('/build/img/exit.svg') }}" alt="Logout Black" class="icon-black">
                        </a>
                    </li>

                   <!-- <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="moon" data-bs-custom-class="tooltip-primary">
                       <a href="#" id="dark-mode-toggle" class="dark-mode-toggle active">
                           <img src="{{ asset('/build/img/Moon-Balck.svg') }}" alt="Dark Mode" class="icon-white">
                       </a>
                       <a href="#" id="light-mode-toggle" class="dark-mode-toggle">
                           <img src="{{ asset('/build/img/Moon-White.svg') }}" alt="Light Mode" class="icon-white">
                       </a>
                   </li> -->
                   <!-- <li>
  <a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
    <img src="{{ asset('/build/img/Moon-Black.svg') }}" alt="Dark Mode" class="dark-icon">
  </a>
  <a href="#" id="light-mode-toggle" class="dark-mode-toggle">
    <i class="ti ti-sun"></i>
  </a>
</li> -->

<!-- 
                   <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Settings" data-bs-custom-class="tooltip-primary">
                       <a href="{{ route('settings') }}" class="{{ request()->is('settings') ? 'active' : '' }}">
                            <img src="{{URL::asset('/build/img/profiles/avatar-11.jpg')}}" alt="Image" class="rounded-circle">
                       </a>
                   </li> -->
               </ul>
           </div>
       </div>
   </div>