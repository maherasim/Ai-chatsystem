@php
    $menuItems = [
        [
            'title' => 'Chats',
            'route' => route('chat.index'),
            'iconWhite' => '/build/img/Chat-White.svg',
            'iconBlack' => '/build/img/Chat-Black.svg',
            'activePattern' => 'chat'
        ],
        [
            'title' => 'Meeting',
            'route' => route('chat-meetings'),
            'iconWhite' => '/build/img/Meeting - White.svg',
            'iconBlack' => '/build/img/Meeting - Black.svg',
            'activePattern' => 'meetings'
        ],
        [
            'title' => 'Todo',
            'route' => route('todos.index'),
            'iconWhite' => '/build/img/ToDo - White.svg',
            'iconBlack' => '/build/img/ToDo - Black.svg',
            'activePattern' => 'todos'
        ],
       
        [
            'title' => 'Ticket',
            'route' => route('chat-ticket'),
            'iconWhite' => '/build/img/ticket_icon_white.svg',
            'iconBlack' => '/build/img/ticket_icon_black.svg',
            'activePattern' => 'ticket'
        ],
        [
            'title' => 'Task',
            'route' => route('chat-task'),
            'iconWhite' => '/build/img/Tasks_icon_white.svg',
            'iconBlack' => '/build/img/Tasks_icon_Balck.svg',
            'activePattern' => 'tasks'
        ],
    ];
    
    $logoUrl = 'https://admin.onlinesystems.info/storage/uploads/settings/app_logo_1758731350.png';
@endphp

<x-app-sidebar :menuItems="$menuItems" :logoUrl="$logoUrl" />