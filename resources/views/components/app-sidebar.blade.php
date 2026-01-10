@props([
    'menuItems' => [],
    'logoUrl' => null,
    'logoAlt' => 'Logo',
    'logoLink' => null
])

<style>
    .dark-icon {
        content: url('/build/img/Moon-Balck.svg');
        transition: 0.3s ease;
    }

    .dark-mode-toggle:hover .dark-icon {
        content: url('/build/img/Moon-White.svg');
    }

    /* Sidebar Icon Fixes */
    .task-icon-link {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .task-icon-link img {
        width: 30px !important;
        height: 30px !important;
        object-fit: contain;
        position: absolute;
    }
    
    /* Active State: White Icon Only */
    .nav-link.active .icon-white {
        display: block !important;
    }
    .nav-link.active .icon-black {
        display: none !important;
    }

    /* Inactive State: Black Icon Only */
    .nav-link:not(.active) .icon-white {
        display: none !important;
    }
    .nav-link:not(.active) .icon-black {
        display: block !important;
    }
    
    /* Hover State: Show White, Hide Black (Like Active) */
    .task-icon-link:hover:not(.active) .icon-white {
        opacity: 1;
        display: block !important;
    }
    .task-icon-link:hover:not(.active) .icon-black {
        display: none !important;
    }
</style>

<div class="sidebar-menu">
    <div class="logo">
        <a href="{{ $logoLink ?? url('/home') }}" class="logo-normal">
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="{{ $logoAlt }}" width="50" height="auto" style="object-fit: contain; width: 50px; height: auto;" title="{{ $logoUrl }}">
            @else
                <img src="{{ asset('build/img/AI-Logo.svg') }}" alt="{{ $logoAlt }}" style="max-width: 70% !important;">
            @endif
        </a>
    </div>
    <div class="menu-wrap">
        <div class="main-menu">
            <ul class="nav">
                @foreach($menuItems as $item)
                    <x-sidebar-menu-item
                        :title="$item['title']"
                        :route="$item['route']"
                        :iconWhite="$item['iconWhite']"
                        :iconBlack="$item['iconBlack']"
                        :active="request()->is($item['activePattern'] ?? '')"
                        :tooltip="$item['tooltip'] ?? $item['title']"
                    />
                @endforeach
            </ul>
        </div>

        <div class="profile-menu">
            <ul>
                {{ $profileMenu ?? '' }}
            </ul>
        </div>
    </div>
</div>

