 <div class="chat-header">
     <div class="user-details">
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

            <img src="{{ $imageUrl }}"
                 class="rounded-circle"
                 alt="image">


         </div>
         <div class="ms-2 overflow-hidden">
             <h6>{{ auth()->user()->name }}</h6>
             <p class="last-seen text-truncate"> {{ auth()->user()->type ?? 'Admin' }}</p>
         </div>
     </div>
     

     <!-- Right Side Icons -->
    <div class="left-icons d-flex align-items-center gap-5" style="display: flex !important; visibility: visible !important; opacity: 1 !important;">
        <li style="list-style: none; display: list-item !important; visibility: visible !important; opacity: 1 !important;">
             <!-- Moon Icon -->
            <a href="#" id="dark-mode-toggle" style="display: inline !important; visibility: visible !important; opacity: 1 !important;">
                <img src="{{ URL::asset('/build/img/Moon.svg') }}" alt="moon" style="height: 25px; cursor: pointer; visibility: visible !important; opacity: 1 !important;">
             </a>

             <!-- Sun Icon -->
            <a href="#" id="light-mode-toggle" style="display: none; visibility: visible !important; opacity: 1 !important;">
                <i class="ti ti-sun" style="font-size: 22px; cursor: pointer; visibility: visible !important; opacity: 1 !important;"></i>
             </a>
         </li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline !important; visibility: visible !important; opacity: 1 !important;">
             @csrf
            <button type="submit" style="background: none; border: none; padding: 0; margin: 0; cursor: pointer; visibility: visible !important; opacity: 1 !important;">
                <img src="{{ URL::asset('/build/img/exit.svg') }}" alt="Logout" style="height: 25px; cursor: pointer; visibility: visible !important; opacity: 1 !important;">
             </button>
        </form>
    </div>
     </div>
