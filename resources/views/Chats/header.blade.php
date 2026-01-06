<div class="chat-header d-flex justify-content-between align-items-center flex-wrap" style="gap: 10px;">
    <!-- LEFT: User Info -->
    <div class="user-details d-flex align-items-center" style="flex: 1 1 auto; min-width: 0;">
        <div class="d-xl-none">
            <a class="text-muted chat-close me-2" href="#">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="avatar avatar-lg online flex-shrink-0">
            @php
                $imageUrl = asset('build/img/profiles/avatar-16.jpg');

                $firstHeader = null;
                if (isset($headers)) {
                    $firstHeader = is_array($headers)
                        ? ($headers[0] ?? null)
                        : (method_exists($headers, 'first') ? $headers->first() : null);
                }

                if ($firstHeader && !empty($firstHeader->image)) {
                    $imageUrl = asset('storage/' . $firstHeader->image);
                } elseif (auth()->check()) {
                    $userObj = auth()->user();
                    if (!empty($userObj->image)) {
                        $imageUrl = asset('storage/' . $userObj->image);
                    } elseif (!empty($userObj->profile_image)) {
                        $imageUrl = asset('storage/' . $userObj->profile_image);
                    }
                }
            @endphp
            <img src="{{ $imageUrl }}" class="rounded-circle" alt="image">
        </div>
        <div class="ms-2 overflow-hidden" style="min-width: 0;">
            <h6 class="mb-0 text-truncate" style="max-width: 200px;">{{ auth()->user()->name }}</h6>
            <p class="last-seen text-truncate mb-0" style="max-width: 200px;">{{ auth()->user()->type ?? 'Admin' }}</p>
        </div>
    </div>

    <!-- RIGHT: Theme Toggle + Logout -->
    <div class="left-icons d-flex align-items-center" style="flex-shrink: 0; gap: 0.75rem;">
        <!-- Dark Mode Toggle -->
        <a href="#" id="dark-mode-toggle" style="display: inline-block; flex-shrink: 0;">
            <img src="{{ URL::asset('/build/img/Moon.svg') }}" alt="moon" style="height: 25px; cursor: pointer; max-width: 25px;">
        </a>
        <!-- Light Mode Toggle -->
        <a href="#" id="light-mode-toggle" style="display: none; flex-shrink: 0;">
            <i class="ti ti-sun" style="font-size: 22px; cursor: pointer;"></i>
        </a>

        <!-- Logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline-block; margin: 0; flex-shrink: 0;">
            @csrf
            <button type="submit" style="background: none; border: none; padding: 0; margin: 0; cursor: pointer;">
                <img src="{{ URL::asset('/build/img/exit.svg') }}" alt="Logout" style="height: 25px; cursor: pointer; max-width: 25px;">
            </button>
        </form>
    </div>
</div>
