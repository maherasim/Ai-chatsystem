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
                $defaultImage = asset('build/img/profiles/avatar-16.jpg');

                $firstHeader = null;
                if (isset($headers)) {
                    $firstHeader = is_array($headers)
                        ? ($headers[0] ?? null)
                        : (method_exists($headers, 'first') ? $headers->first() : null);
                }

                if ($firstHeader && !empty($firstHeader->image)) {
                    // Handle header image
                    $imgPath = $firstHeader->image;
                    if (strpos($imgPath, 'storage/') === 0) {
                        $imgPath = substr($imgPath, 8);
                    }
                    $imagePath = 'storage/' . $imgPath;
                    if (file_exists(public_path($imagePath))) {
                        $imageUrl = asset($imagePath);
                    }
                } elseif (auth()->check()) {
                    $userObj = auth()->user();
                    
                    // Check profile_image first (stored as 'profiles/filename.jpg' in storage)
                    if (!empty($userObj->profile_image)) {
                        $imgPath = $userObj->profile_image;
                        // If it already starts with storage/, use it as is
                        if (strpos($imgPath, 'storage/') === 0) {
                            $imagePath = $imgPath;
                        } else {
                            // Otherwise, prepend storage/
                            $imagePath = 'storage/' . $imgPath;
                        }
                        
                        if (file_exists(public_path($imagePath))) {
                            $imageUrl = asset($imagePath);
                        } else {
                            // Try without storage/ prefix (in case it's already a full path)
                            $altPath = str_replace('storage/', '', $imagePath);
                            if (file_exists(public_path('storage/' . $altPath))) {
                                $imageUrl = asset('storage/' . $altPath);
                            }
                        }
                    }
                    
                    // Fallback to image field (stored as 'upload/users/filename.jpg')
                    if ($imageUrl === $defaultImage && !empty($userObj->image)) {
                        $imgPath = $userObj->image;
                        // If it's already a public path (upload/users/...)
                        if (strpos($imgPath, 'upload/') === 0) {
                            if (file_exists(public_path($imgPath))) {
                                $imageUrl = asset($imgPath);
                            }
                        } elseif (strpos($imgPath, 'storage/') === 0) {
                            if (file_exists(public_path($imgPath))) {
                                $imageUrl = asset($imgPath);
                            }
                        } else {
                            // Try with storage/ prefix
                            $imagePath = 'storage/' . $imgPath;
                            if (file_exists(public_path($imagePath))) {
                                $imageUrl = asset($imagePath);
                            }
                        }
                    }
                }
            @endphp
            <img src="{{ $imageUrl }}" 
                 class="rounded-circle" 
                 alt="Developer Image"
                 onerror="this.onerror=null; this.src='{{ $defaultImage }}';"
                 style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #e2e8f0;">
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
