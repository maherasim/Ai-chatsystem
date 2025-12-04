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
     <div class="left-icons d-flex align-items-center gap-5">

         {{-- <li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="tooltip-primary" style="list-style: none;">
             <a href="{{ route('settings') }}" class="{{ request()->is('settings') ? 'active' : '' }}">
                 <img src="{{URL::asset('/build/img/setting.svg')}}" alt="setting" style="height: 25px; cursor: pointer;">
             </a>
         </li>

         <li style="list-style: none;">
             <!-- Moon Icon -->
             <a href="#" id="dark-mode-toggle" style="display: inline;">
                 <img src="{{ URL::asset('/build/img/Moon.svg') }}" alt="moon" style="height: 25px; cursor: pointer;">
             </a>

             <!-- Sun Icon -->
             <a href="#" id="light-mode-toggle" style="display: none;">
                 <i class="ti ti-sun" style="font-size: 22px; cursor: pointer;"></i>
             </a>
         </li>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
             @csrf
             <button type="submit" style="background: none; border: none; padding: 0; margin: 0;">
                 <img src="{{ URL::asset('/build/img/exit.svg') }}" alt="Logout" style="height: 25px; cursor: pointer;">
             </button>
         </form> --}}
     </div>
 </div>