@props([
    'title' => '',
    'route' => '#',
    'iconWhite' => '',
    'iconBlack' => '',
    'active' => false,
    'tooltip' => ''
])

<li data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="{{ $tooltip ?: $title }}" data-bs-custom-class="tooltip-primary">
    <a href="{{ $route }}" class="nav-link task-icon-link {{ $active ? 'active' : '' }}">
        <img src="{{ asset($iconWhite) }}" alt="{{ $title }} White" class="icon-white" style="width: 30px !important; height: 30px !important;">
        <img src="{{ asset($iconBlack) }}" alt="{{ $title }} Black" class="icon-black">
    </a>
</li>

