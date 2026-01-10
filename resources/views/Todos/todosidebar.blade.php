@php
    $menuItems = [
        [
            'title' => 'Todo',
            'route' => route('todos.index'),
            'iconWhite' => '/build/img/ToDo - White.svg',
            'iconBlack' => '/build/img/ToDo - Black.svg',
            'activePattern' => 'todo'
        ],
    ];
    
    $logoUrl = 'https://admin.onlinesystems.info/storage/uploads/settings/app_logo_1758731350.png';
@endphp

<x-app-sidebar :menuItems="$menuItems" :logoUrl="$logoUrl" />