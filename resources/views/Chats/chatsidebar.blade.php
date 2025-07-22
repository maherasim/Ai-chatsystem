<div class="menu-wrap">
    <div class="main-menu">
        <ul class="nav">
            <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="AI" data-bs-custom-class="tooltip-primary">
                <a href="{{ route('chat-ai') }}" class="nav-link task-icon-link {{ request()->is('Ai') ? 'active' : '' }}">
                    <img src="{{ asset('/build/img/AI-White.svg') }}" alt="AI Icon" class="icon-white">
                    <img src="{{ asset('/build/img/AI-Black.svg') }}" alt="AI Icon" class="icon-black">
                </a>
            </li>

            <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Chats" data-bs-custom-class="tooltip-primary">
                <a href="{{ route('home') }}" class="nav-link task-icon-link {{ request()->is('/') ? 'active' : '' }}">
                    <img src="{{ asset('/build/img/Chat-White.svg') }}" alt="White Icon" class="icon-white">
                    <img src="{{ asset('/build/img/Chat-Black.svg') }}" alt="Black Icon" class="icon-black">
                </a>
            </li>

            <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Tasks" data-bs-custom-class="tooltip-primary">
                <a href="{{ route('chat-task') }}" class="nav-link task-icon-link {{ request()->is('tasks') ? 'active' : '' }}">
                    <img src="{{ asset('/build/img/Tasks-White.svg') }}" alt="Task White" class="icon-white">
                    <img src="{{ asset('/build/img/Tasks-Black.svg') }}" alt="Task Black" class="icon-black">
                </a>
            </li>

            <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Users" data-bs-custom-class="tooltip-primary">
                <a href="{{ route('chat-users') }}" class="nav-link task-icon-link {{ request()->is('users') ? 'active' : '' }}">
                    <img src="{{ asset('/build/img/Users-White.svg') }}" alt="User White" class="icon-white">
                    <img src="{{ asset('/build/img/Users-Black.svg') }}" alt="User Black" class="icon-black">
                </a>
            </li>

            <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Groups" data-bs-custom-class="tooltip-primary">
                <a href="{{ route('chat-groups') }}" class="nav-link task-icon-link {{ request()->is('groups') ? 'active' : '' }}">
                    <img src="{{ asset('/build/img/Group-White.svg') }}" alt="Group White" class="icon-white">
                    <img src="{{ asset('/build/img/Group-Black.svg') }}" alt="Group Black" class="icon-black">
                </a>
            </li>

            <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="API" data-bs-custom-class="tooltip-primary">
                <a href="{{ route('chat-api') }}" class="nav-link task-icon-link {{ request()->is('Apis') ? 'active' : '' }}">
                    <img src="{{ asset('/build/img/API-White.svg') }}" alt="API White" class="icon-white">
                    <img src="{{ asset('/build/img/API-Black.svg') }}" alt="API Black" class="icon-black">
                </a>
            </li>

            <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Project" data-bs-custom-class="tooltip-primary">
                <a href="{{ route('chat-project') }}" class="nav-link task-icon-link {{ request()->is('project') ? 'active' : '' }}">
                    <img src="{{ asset('/build/img/Project-White.svg') }}" alt="Project White" class="icon-white">
                    <img src="{{ asset('/build/img/Project-Black.svg') }}" alt="Project Black" class="icon-black">
                </a>
            </li>

            <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Library" data-bs-custom-class="tooltip-primary">
                <a href="{{ route('chat-library') }}" class="nav-link task-icon-link {{ request()->is('library') ? 'active' : '' }}">
                    <img src="{{ asset('/build/img/Library-White.svg') }}" alt="Library White" class="icon-white">
                    <img src="{{ asset('/build/img/Library-Black.svg') }}" alt="Library Black" class="icon-black">
                </a>
            </li>
        </ul>
    </div>

    <div class="profile-menu">
        <ul>
            <div class="dropdown">
                <a href="#" class="nav-link avatar avatar-md" data-bs-toggle="dropdown">
                    <img src="{{ asset('/build/img/profiles/avatar-16.jpg') }}" alt="img" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end p-3">
                    <a href="{{ url('signin') }}" class="dropdown-item"><i class="ti ti-logout-2 me-2"></i>Logout</a>
                </div>
            </div>

            <li>
                <a href="#" id="dark-mode-toggle" class="dark-mode-toggle active">
                    <img src="{{ asset('/build/img/Moon-Balck.svg') }}" alt="Dark Mode" class="icon-white">
                </a>
                <a href="#" id="light-mode-toggle" class="dark-mode-toggle">
                    <img src="{{ asset('/build/img/Moon-White.svg') }}" alt="Light Mode" class="icon-white">
                </a>
            </li>

            <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Settings" data-bs-custom-class="tooltip-primary">
                <a href="{{ route('settings') }}" class="{{ request()->is('settings') ? 'active' : '' }}">
                    <img src="{{ asset('/build/img/Settings-Balck.svg') }}" alt="Settings" class="icon-white">
                </a>
            </li>

        </ul>
    </div>
</div>