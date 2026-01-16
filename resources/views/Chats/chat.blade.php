<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')
@php
    $currentUser = Auth::user();
    $currentUserId = (string)($currentUser->_id ?? '');
@endphp
<meta name="user-id" content="{{ $currentUserId }}">
<script>
    window.currentUserId = '{{ $currentUserId }}';
    @php
        $currentUserAvatar = '';
        if (isset($currentUser)) {
            // Check image field first (stored in public/upload/users/) for consistency
            if (!empty($currentUser->image)) {
                if (strpos($currentUser->image, 'upload/') === 0) {
                    $currentUserAvatar = asset($currentUser->image);
                } else {
                    $currentUserAvatar = asset('storage/' . $currentUser->image);
                }
            }
            // Fallback to profile_image (stored in storage/app/public/profiles/)
            elseif (!empty($currentUser->profile_image)) {
                $currentUserAvatar = asset('storage/' . $currentUser->profile_image);
            }
        }
    @endphp
    window.currentUserAvatar = '{{ $currentUserAvatar }}';
    window.baseUrl = '{{ url("/") }}';
</script>
<style>
    body {
        overflow-x: hidden;
    }


    .accordion-button::after {
        display: none !important;
    }

    .dropdown-menu {
        max-height: 300px;
        /* or adjust */
        overflow-y: auto;
        overflow-x: hidden;
    }

    /* Fix image display in chat messages - make images fully visible */
    .chat-img .img-wrap {
        height: auto !important;
        min-height: 120px;
        max-height: 500px;
        max-width: 100%;
        flex: none !important;
    }

    .chat-img .img-wrap img {
        width: 100% !important;
        height: auto !important;
        max-width: 100%;
        max-height: 500px;
        object-fit: contain !important;
        object-position: center;
    }

    .chat-img {
        max-width: 100% !important;
        width: 100%;
    }

    .chats .chat-content .message-content .chat-img {
        max-width: 100% !important;
    }

    /* Allow images to use more width in message bubbles */
    .chats .chat-content .message-content:has(.chat-img),
    .chats-right .chat-content .message-content:has(.chat-img) {
        max-width: 85% !important;
    }

    /* Fallback for browsers that don't support :has() */
    .chats .chat-content .message-content .chat-img,
    .chats-right .chat-content .message-content .chat-img {
        max-width: 100% !important;
        width: 100%;
    }

    /* Professional file attachment styling */
    .file-attach-professional {
        transition: all 0.3s ease;
    }

    .file-attach-professional:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
        border-color: #6338F6 !important;
    }

    .file-attach-professional .download-btn:hover {
        background: #5229d4 !important;
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(99, 56, 246, 0.3) !important;
    }

    .file-attach-professional .view-btn:hover {
        background: #dee2e6 !important;
        color: #212529 !important;
        transform: scale(1.05);
    }

    /* Ensure file attachments don't overflow */
    .chats .chat-content .message-content .file-attach-professional,
    .chats-right .chat-content .message-content .file-attach-professional {
        max-width: 100%;
        width: 100%;
    }

    /* Prevent parent containers from overflowing */
    .main_content,
    .sidebar-group {
        overflow: visible !important;
    }

    /* Ensure base styles don't interfere */
    .task-icon-link {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 30px;
    }

    /* Favorite button styling */
    .favorite-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        color: #6c757d;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 10;
    }

    .favorite-btn:hover {
        background: rgba(255, 255, 255, 1);
        color: #dc3545;
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .favorite-btn.favorited {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545 !important;
    }

    .favorite-btn.favorited:hover {
        background: rgba(220, 53, 69, 0.2);
        color: #dc3545 !important;
    }

    .favorite-btn.favorited i {
        color: #dc3545 !important;
        font-size: 16px;
    }

    .favorite-btn i {
        font-size: 16px;
    }

    /* Favorite button in image overlay */
    .img-wrap .img-overlay .favorite-btn {
        position: absolute;
        top: 8px;
        right: 8px;
    }

    /* Favorite button in document item */
    .document-item .favorite-btn {
        width: 28px;
        height: 28px;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
    }

    .document-item .favorite-btn:hover {
        background: #fff;
        border-color: #dc3545;
    }

    .document-item .favorite-btn.favorited {
        background: rgba(220, 53, 69, 0.1);
        border-color: #dc3545;
        color: #dc3545 !important;
    }

    .document-item .favorite-btn.favorited i {
        color: #dc3545 !important;
    }

    /* Favorite button in link item */
    .link-item .favorite-btn {
        width: 28px;
        height: 28px;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        margin-left: 8px;
    }

    .link-item .favorite-btn:hover {
        background: #fff;
        border-color: #dc3545;
    }

    .link-item .favorite-btn.favorited {
        background: rgba(220, 53, 69, 0.1);
        border-color: #dc3545;
        color: #dc3545 !important;
    }

    .link-item .favorite-btn.favorited i {
        color: #dc3545 !important;
    }

    .chat-dropdown {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }


    .task-icon-link img {
        width: 25px !important;
        height: 25px !important;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: opacity 0.2s ease-in-out;
    }


    /* Stack both icons centered */
    .task-icon-link img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: opacity 0.2s ease-in-out;
        width: 16px;
        height: 16px;
    }

    /* Default: show black icon */
    .task-icon-link .icon-black {
        opacity: 1;
    }

    /* Default: hide white icon */
    .task-icon-link .icon-white {
        opacity: 0;
    }

    /* On hover (only if not active): show white icon */
    .task-icon-link:hover:not(.active) .icon-black {
        opacity: 0;
    }

    .task-icon-link:hover:not(.active) .icon-white {
        opacity: 1;
    }

    /* Chat Loader Styles */
    .chat-loader-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
        display: none;
        width: 200px;
        height: 200px;
        filter: url('#goo');
        animation: rotate-move 2s ease-in-out infinite;
    }

    .chat-loader-container.active {
        display: block;
    }

    .chat-loader-wrapper {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .chat-loader-dot {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background-color: #000;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
    }

    .chat-loader-dot.dot-3 {
        background-color: #f74d75;
        animation: dot-3-move 2s ease infinite, index 6s ease infinite;
    }

    .chat-loader-dot.dot-2 {
        background-color: #10beae;
        animation: dot-2-move 2s ease infinite, index 6s -4s ease infinite;
    }

    .chat-loader-dot.dot-1 {
        background-color: #ffe386;
        animation: dot-1-move 2s ease infinite, index 6s -2s ease infinite;
    }

    @keyframes dot-3-move {
        20% {transform: scale(1)}
        45% {transform: translateY(-18px) scale(.45)}
        60% {transform: translateY(-90px) scale(.45)}
        80% {transform: translateY(-90px) scale(.45)}
        100% {transform: translateY(0px) scale(1)}
    }

    @keyframes dot-2-move {
        20% {transform: scale(1)}
        45% {transform: translate(-16px, 12px) scale(.45)}
        60% {transform: translate(-80px, 60px) scale(.45)}
        80% {transform: translate(-80px, 60px) scale(.45)}
        100% {transform: translateY(0px) scale(1)}
    }

    @keyframes dot-1-move {
        20% {transform: scale(1)}
        45% {transform: translate(16px, 12px) scale(.45)}
        60% {transform: translate(80px, 60px) scale(.45)}
        80% {transform: translate(80px, 60px) scale(.45)}
        100% {transform: translateY(0px) scale(1)}
    }

    @keyframes rotate-move {
        55% {transform: translate(-50%, -50%) rotate(0deg)}
        80% {transform: translate(-50%, -50%) rotate(360deg)}
        100% {transform: translate(-50%, -50%) rotate(360deg)}
    }

    @keyframes index {
        0%, 100% {z-index: 3}
        33.3% {z-index: 2}
        66.6% {z-index: 1}
    }

    /* Active state (white icon always shown) */
    .task-icon-link.active .icon-black {
        opacity: 0;
    }

    .task-icon-link.active .icon-white {
        opacity: 1;
    }

    .chat-options .btn img {
        box-shadow: none !important;
    }

    .chat-options .btn:focus,
    .chat-options .btn:active,
    .chat-options .btn:focus-visible,
    .chat-options .btn:focus-within {
        box-shadow: none !important;
        outline: none !important;
    }

    .chat-options .btn {
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
    }

    .chat-body {
        height: calc(100vh - 200px); /* Adjust based on header and footer height */
        overflow-y: auto !important;
        display: flex;
        flex-direction: column;
    }

    .messages {
        flex: 1;
    }
    
    /* Chat background overlay for readability - only show when background is set */
    .chat-body.has-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.3);
        z-index: 0;
        pointer-events: none;
    }

    /* Ensure chat footer stays above messages */
    .chat-footer {
        position: relative;
        z-index: 100 !important;
    }

    .chat-footer .footer-form {
        z-index: 100 !important;
        position: relative;
    }

    .chat-footer .footer-form .chat-footer-wrap {
        position: relative;
        z-index: 101 !important;
    }

    /* Drag and Drop Styles */
    .chat-footer.drag-over,
    .chat-body.drag-over,
    .main-chat-blk.drag-over,
    .chat.drag-over {
        position: relative;
        transition: all 0.3s ease;
    }

    .chat-footer.drag-over::before,
    .chat-body.drag-over::before,
    .main-chat-blk.drag-over::before,
    .chat.drag-over::before {
        content: 'Drop files here to send';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(99, 56, 246, 0.95);
        color: white;
        padding: 20px 40px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 500;
        z-index: 1000;
        pointer-events: none;
        box-shadow: 0 4px 20px rgba(99, 56, 246, 0.3);
        white-space: nowrap;
    }

    /* Professional Receiver Message UI - Cleaner Design */
    .chats:not(.chats-right) .chat-profile-name {
        margin-bottom: 6px;
    }

    .chats:not(.chats-right) .chat-profile-name h6 {
        font-size: 13px !important;
        font-weight: 500 !important;
        color: #495057 !important;
        margin-bottom: 0 !important;
        line-height: 1.4 !important;
    }

    .chats:not(.chats-right) .chat-profile-name .chat-time {
        font-size: 11px !important;
        color: #6c757d !important;
        font-weight: 400 !important;
        margin-left: 8px !important;
    }

    .chats:not(.chats-right) .chat-profile-name .msg-read {
        margin-left: 4px !important;
    }

    .chats:not(.chats-right) .chat-profile-name .msg-read i {
        font-size: 12px !important;
    }

    /* Remove the circle icon between name and time for cleaner look */
    .chats:not(.chats-right) .chat-profile-name .ti-circle-filled {
        display: none !important;
    }

    /* Message Bubble Size Reduction */
    .chats .chat-content .message-content,
    .chats-right .chat-content .message-content,
    .chats-right .chat-info .message-content {
        padding: 4px 16px !important; /* Reduced vertical padding (height), increased horizontal padding */
        min-height: unset !important;
        margin-bottom: 4px !important;
        line-height: 1.4 !important; /* Tighter line height to reduce height */
    }

    .chats .chat-content .message-content {
        border-radius: 12px 12px 12px 0 !important;
        max-width: 75% !important; /* Optimal max-width for message bubbles */
        width: auto !important; /* Allow natural width based on content */
        min-width: fit-content !important; /* Ensure minimum width fits content */
        display: inline-block !important; /* Make it inline-block for proper sizing */
        word-wrap: break-word !important; /* Break long words if they exceed container */
        overflow-wrap: break-word !important; /* Break words if they're too long */
        white-space: normal !important; /* Normal text flow - wrap when needed */
        word-break: break-word !important; /* Break long words if necessary */
        hyphens: none !important; /* Don't add hyphens */
    }
    
    /* Left-side (received) message content styling */
    .chats:not(.chats-right) .chat-info > .message-content {
        max-width: 75% !important; /* Optimal max-width for message bubbles */
        width: auto !important; /* Allow natural width based on content */
        min-width: fit-content !important; /* Ensure minimum width fits content */
        display: inline-block !important; /* Make it inline-block for proper sizing */
        line-height: 1.4 !important; /* Tighter line height to reduce height */
        word-wrap: break-word !important; /* Break long words if they exceed container */
        overflow-wrap: break-word !important; /* Break words if they're too long */
        white-space: normal !important; /* Normal text flow - wrap when needed */
        word-break: break-word !important; /* Break long words if necessary */
        hyphens: none !important; /* Don't add hyphens */
    }

    .chats-right .chat-content .message-content,
    .chats-right .chat-info .message-content {
        border-radius: 16px 16px 2px 16px !important;
    }

    /* Message Alignment Fix */
    .chats.chats-right {
        justify-content: flex-end !important;
        margin-left: auto !important;
        text-align: right !important;
        flex-direction: row !important;
        margin-bottom: 15px !important;
    }

    .chats.chats-right .chat-content {
        order: 1 !important;
        text-align: right !important;
        align-items: flex-end !important;
        display: flex !important;
        flex-direction: column !important;
    }

    .chats.chats-right .chat-avatar {
        order: 2 !important;
        padding-right: 0 !important;
        padding-left: 8px !important;
    }

    .chats.chats-right .chat-profile-name {
        text-align: right !important;
        width: 100% !important;
        margin-bottom: 5px !important;
    }

    .chats.chats-right .chat-info {
        display: flex !important;
        flex-direction: row !important; /* Changed from column to row */
        align-items: center !important; /* Center items vertically */
        justify-content: flex-end !important; /* Align to the right */
        gap: 8px !important; /* Space between dots and bubble */
    }

    /* Target ONLY the inner message content to avoid double bubbles */
    .chats.chats-right .message-content .message-content {
        background: none !important;
        padding: 0 !important;
        color: inherit !important;
    }

    .chats.chats-right .chat-info > .message-content {
        background: linear-gradient(135deg, #0d6efd 0%, #0052cc 100%) !important;
        color: #ffffff !important;
        border-radius: 16px 16px 2px 16px !important;
        padding: 4px 16px !important; /* Reduced vertical padding (height), increased horizontal padding */
        display: inline-block !important;
        width: auto !important; /* Allow natural width based on content */
        min-width: fit-content !important; /* Ensure minimum width fits content */
        max-width: 75% !important; /* Optimal max-width for message bubbles */
        flex: 0 1 auto !important;
        text-align: left !important; /* Keep text left aligned inside bubble */
        box-shadow: 0 2px 5px rgba(13, 110, 253, 0.2) !important;
        word-wrap: break-word !important; /* Break long words if they exceed container */
        overflow-wrap: break-word !important; /* Break words if they're too long */
        white-space: normal !important; /* Normal text flow - wrap when needed */
        word-break: break-word !important; /* Break long words if necessary */
        hyphens: none !important; /* Don't add hyphens */
        min-height: unset !important;
        line-height: 1.4 !important; /* Tighter line height to reduce height */
    }
    .chats.chats-right .chat-time-status {
        text-align: right !important;
        margin-top: 2px !important;
        line-height: 1 !important;
        font-size: 11px !important;
        color: #adb5bd !important;
        display: flex !important;
        align-items: center !important;
        justify-content: flex-end !important;
        gap: 4px !important;
    }

    .chats:not(.chats-right) .chat-time-status {
        text-align: left !important;
        margin-top: 2px !important;
        line-height: 1 !important;
        font-size: 11px !important;
        color: #adb5bd !important;
        display: flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
        gap: 4px !important;
    }

    .emoj-group, .chat-actions {
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease;
    }

    .chats:hover .emoj-group,
    .chats:hover .chat-actions {
        opacity: 1 !important;
        visibility: visible !important;
        display: flex !important;
    }
    
    /* Ensure sender messages show emoji group on hover */
    .chats.chats-right:hover .emoj-group,
    .chats.chats-right:hover .chat-actions {
        opacity: 1 !important;
        visibility: visible !important;
        display: flex !important;
    }

    .emoj-group-list {
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        padding: 12px 10px;
        display: none;
        z-index: 2000 !important;
        width: fit-content;
        min-width: fit-content;
        box-sizing: border-box;
        overflow: visible;
    }
    
    /* When emoji picker is shown, it should always be visible - override any hover rules */
    .emoj-group-list.emoji-picker-shown {
        display: flex !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    
    /* Ensure emoji picker is always visible when shown, regardless of parent hover state */
    .chats:hover .emoj-group-list.emoji-picker-shown,
    .chats .emoj-group-list.emoji-picker-shown {
        display: flex !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .emoj-group-list ul {
        display: flex;
        padding: 0;
        margin: 0;
        list-style: none;
        gap: 6px;
        align-items: center;
        justify-content: center;
        width: 100%;
        flex-wrap: nowrap;
        box-sizing: border-box;
    }

    .emoj-group-list ul li {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    
    /* Emoji picker item hover effects */
    .emoj-group-list .emoji-picker-item {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 40px !important;
        height: 40px !important;
        padding: 0 !important;
        border-radius: 8px;
        transition: all 0.2s ease;
        background: transparent;
        text-decoration: none;
        cursor: pointer;
    }
    
    .emoj-group-list .emoji-picker-item:hover {
        background: #f5f5f5 !important;
        transform: scale(1.1);
    }
    
    .emoj-group-list .emoji-picker-item:active {
        transform: scale(0.95);
    }
    
    .emoj-group-list .emoji-picker-item span {
        font-size: 28px !important;
        line-height: 1 !important;
        user-select: none;
        display: inline-block;
    }

    /* Todo Modal Styles */
    .required {
        border-color: red;
    }

    .invit-img img {
        max-height: 80px;
    }

    .user_div {
        flex: 0 0 auto;
        width: 160px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background: #fff;
        padding: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .user_div.user_active {
        border: 2px solid #22c55e;
        background: #f0fdf4;
        box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
        transform: scale(1.02);
    }

    .priority {
        border: medium;
        background-color: white;
        color: rgb(100, 116, 139);
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        cursor: pointer;
    }

    .priority.active,
    .priority.active1 {
        background-color: rgb(34, 197, 94);
        color: white;
    }

    .reminder-btn, .time-btn {
        border: none;
        background-color: white;
        color: #64748b;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        width: 80px;
        cursor: pointer;
    }

    .reminder-btn.active {
        background-color: #22c55e;
        color: white;
    }

    .time-btn.active {
        background-color: #22c55e;
        color: white;
    }

    .btn-plus {
        background-color: #22c55e;
        border: 1px solid #22c55e;
        color: #FFF;
    }

    .btn-plus span {
        border: solid 1px;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        display: block;
    }

    .btn-minus {
        background-color: #FD3A55;
        border: 1px solid #FD3A55;
        color: #FFF;
    }

    .btn-minus span {
        border: solid 1px;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        display: block;
    }

    .d-flex1 {
        display: flex;
        gap: 8px;
    }

    #timeToday {
        display: flex;
    }

    #endTimeSelect {
        border: none;
        font-size: 13px;
        color: #333;
        background: transparent;
        width: 100%;
        outline: none;
        padding-right: 25px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url('https://cdn-icons-png.flaticon.com/512/2088/2088617.png');
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 15px;
        cursor: pointer;
    }

    .selection {
        color: #64748b;
    }

    .emoj-group ul {
        display: flex;
        align-items: center;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 5px;
    }

    .emoj-group ul li a {
        color: #6c757d;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s;
    }

    .emoj-group ul li a:hover {
        color: #6338F6;
    }

    .chats.chats-right .chat-info > .message-content * {
        color: #ffffff !important;
    }

    .chats.chats-right .chat-time {
        color: #adb5bd !important;
        font-size: 0.75rem !important;
    }
    
    .chats.chats-right .chat-profile-name h6 {
        font-weight: 600 !important;
        color: #495057 !important;
    }
</style>



<!-- content -->
<div class="content main_content">
    @include('Chats.chatsidebar')
    <!-- sidebar group -->
    @include('Chats.notification', ['groups' => $groups ?? collect([])])
    <!-- /Sidebar group -->

    <!-- Chat -->


    <!-- Chat -->
    <div class="chat chat-messages show" id="middle">
        <div>
            <div class="chat-header" style="display: flex; justify-content: space-between; align-items: center; gap: 20px;">

                <!-- LEFT: User Info -->
                <div class="user-details d-flex align-items-center gap-2">
                    <div class="d-xl-none">
                        <a class="text-muted chat-close me-2" href="#">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <div class="avatar avatar-lg online flex-shrink-0">
                        @php
    $headerAvatar = asset('build/img/profiles/avatar-16.jpg');
    
    // Always prioritize current user's image first
    if (auth()->check()) {
        $userObj = auth()->user();
        // Check image field first (stored in public/upload/users/) for consistency
        if (!empty($userObj->image)) {
            // Check if path starts with upload/ (public directory) or use storage/
            if (strpos($userObj->image, 'upload/') === 0) {
                $headerAvatar = asset($userObj->image);
            } else {
                $headerAvatar = asset('storage/' . $userObj->image);
            }
        }
        // Fallback to profile_image (stored in storage/app/public/profiles/)
        elseif (!empty($userObj->profile_image)) {
            $headerAvatar = asset('storage/' . $userObj->profile_image);
        }
        // Fallback to Setting model for current user
        else {
            $userSetting = \App\Models\Setting::where('user_id', auth()->id())->first();
            if ($userSetting && !empty($userSetting->image)) {
                if (strpos($userSetting->image, 'upload/') === 0) {
                    $headerAvatar = asset($userSetting->image);
                } else {
                    $headerAvatar = asset('storage/' . $userSetting->image);
                }
            }
        }
    }
@endphp
<img id="chatHeaderAvatar" src="{{ $headerAvatar }}"
     class="rounded-circle"
     alt="image"
     onerror="this.onerror=null; this.src='{{ asset('build/img/profiles/avatar-16.jpg') }}';">
                    </div>
                    <div class="ms-2 overflow-hidden">
                        <h6 id="chatHeaderName">{{$header->first_name ?? 'Chat'}}</h6>
                        <span class="last-seen">Online</span>
                    </div>
                </div>

                <!-- CENTER: Chat Options -->
                <div class="chat-options">
                    <ul class="d-flex align-items-center gap-3 list-unstyled mb-0">
                        <li>
                            <a href="javascript:void(0)" class="btn chat-search-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Search" data-bs-original-title="Search">
                                <img src="{{ asset('/build/img/Search-Black.svg') }}" alt="Search" width="18px">
                                <img src="{{ asset('/build/img/Search-White.svg') }}" alt="Search" width="18px">
                            </a>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Video Call" data-bs-original-title="Video Call">
                            <a href="javascript:void(0)" class="btn" data-bs-toggle="modal" data-bs-target="#video-call">
                                <img src="{{ asset('/build/img/VideoCall-Black.svg') }}" alt="Video Call" width="18px">
                                <img src="{{ asset('/build/img/VideoCall-White.svg') }}" alt="Video Call" width="18px">
                            </a>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Voice Call" data-bs-original-title="Voice Call">
                            <a href="javascript:void(0)" class="btn" data-bs-toggle="modal" data-bs-target="#voice_call">
                                <img src="{{ asset('/build/img/Call-Black.svg') }}" alt="Voice Call" width="18px">
                                <img src="{{ asset('/build/img/Call-White.svg') }}" alt="Voice Call" width="18px">
                            </a>
                        </li>
                        <li data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Contact Info" data-bs-original-title="Contact Info">
                            <a href="javascript:void(0)" class="btn" data-bs-toggle="offcanvas" data-bs-target="#contact-profile">
                                <img src="{{ asset('/build/img/User-Info-Black.svg') }}" alt="User Info" width="18px">
                                <img src="{{ asset('/build/img/User-Info-White.svg') }}" alt="User Info" width="18px">
                            </a>
                        </li>
                    </ul>
                </div>

 

                <!-- RIGHT: Settings, Theme Toggle, Logout -->
                <div class="right-icons d-flex align-items-center gap-4">
                </div>
                <div class="chat-search search-wrap contact-search">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Contacts">
                            <span class="input-group-text"><i class="ti ti-search"></i></span>
                        </div>
                    </form>
                </div>

            </div>

            @php
                $chatBgSetting = \App\Models\Setting::where('user_id', auth()->id())->first();
                $chatBackgrounds = $chatBgSetting && $chatBgSetting->chat_backgrounds
                    ? json_decode($chatBgSetting->chat_backgrounds, true)
                    : [];
                $selectedChatBgIndex = $chatBgSetting->selected_chat_background ?? null;
                $chatBackgroundUrl = null;
                if ($selectedChatBgIndex !== null && isset($chatBackgrounds[$selectedChatBgIndex])) {
                    $chatBackgroundUrl = asset($chatBackgrounds[$selectedChatBgIndex]);
                }
            @endphp
            <div class="chat-body chat-page-group slimscroll {{ $chatBackgroundUrl ? 'has-background' : '' }}" id="chatBody" style="position: relative; @if($chatBackgroundUrl) background-image: url('{{ $chatBackgroundUrl }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; @endif">
                <!-- Chat Loader -->
                <div class="chat-loader-container" id="chatLoader">
                    <div class="chat-loader-wrapper">
                        <div class="chat-loader-dot dot-1"></div>
                        <div class="chat-loader-dot dot-2"></div>
                        <div class="chat-loader-dot dot-3"></div>
                    </div>
                </div>
                <div class="messages" id="chatMessagesContainer" style="position: relative; z-index: 1; padding-bottom: 80px;">
                    <!-- Dynamic messages will be rendered here -->
                    <div id="emptyChatState" style="display: flex; align-items: center; justify-content: center; height: 100%; min-height: 400px; flex-direction: column; color: #7f8ea3;">
                        <i class="ti ti-message-circle" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
                        <p style="font-size: 16px; margin: 0;">Select a group to start chatting</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-footer">
            <form class="footer-form">
                <div class="chats reply-chat reply-div" id="reply-div">
                    <div class="chat-avatar">
                        <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="image">
                    </div>
                    <div class="chat-content">
                        <div class="chat-profile-name">
                            <h6>Edward Lietz<i class="ti ti-circle-filled fs-7 mx-2"></i><span class="chat-time">02:39 PM</span><span class="msg-read success"><i class="ti ti-checks"></i></span></h6>
                        </div>
                        <div class="chat-info">
                            <div class="message-content">
                                <div class="message-reply reply-content">
                                    Thank you for your support
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="close-replay">
                        <i class="ti ti-x"></i>
                    </a>
                </div>
                <div class="chat-footer-wrap">
                    <div class="form-item">
                        <a href="#" class="action-circle"><i class="ti ti-microphone"></i></a>
                    </div>
                    <div class="form-wrap">
                        <input type="text" class="form-control" placeholder="Type Your Message">
                    </div>
                    <div class="form-item emoj-action-foot">
                        <a href="#" class="action-circle"><i class="ti ti-mood-smile"></i></a>
                        <div class="emoj-group-list-foot down-emoji-circle">
                            <ul>
                                <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon"></a></li>
                                <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon"></a></li>
                                <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon"></a></li>
                                <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon"></a></li>
                                <li><a href="javascript:void(0);"><img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon"></a></li>
                                <li class="add-emoj"><a href="javascript:void(0);"><i class="ti ti-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-item position-relative d-flex align-items-center justify-content-center ">
                        <a href="#" class="action-circle file-action position-absolute">
                            <i class="ti ti-folder"></i>
                        </a>
                        <input type="file" class="open-file position-relative" name="files" id="files" accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar">
                    </div>
                    <div class="form-item">
                        <a href="#" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-3">
                            <a href="#" class="dropdown-item"><i class="ti ti-camera-selfie me-2"></i>Camera</a>
                            <a href="#" class="dropdown-item"><i class="ti ti-photo-up me-2"></i>Gallery</a>
                            <a href="#" class="dropdown-item"><i class="ti ti-music me-2"></i>Audio</a>
                            <a href="#" class="dropdown-item"><i class="ti ti-map-pin-share me-2"></i>Location</a>
                            <a href="#" class="dropdown-item"><i class="ti ti-user-check me-2"></i>Contact</a>
                        </div>
                    </div>
                    <div class="form-btn">
                        <button class="btn btn-primary" type="submit">
                            <i class="ti ti-send"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /Chat -->

    <!-- Contact Info -->
    <div class="chat-offcanvas offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="contact-profile" aria-labelledby="chatUserMoreLabel">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="chatUserMoreLabel">Contact Info</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-x"></i></button>
        </div>
        <div class="offcanvas-body">
            <div class="chat-contact-info">
                <div class="profile-content">
                    <div class="contact-profile-info">
                        <div class="avatar avatar-xxl online mb-2">
                            <img id="contactProfileAvatar" src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="img" onerror="this.onerror=null; this.src='{{ asset('build/img/profiles/avatar-06.jpg') }}';">
                        </div>
                        <h6 id="contactProfileName">Select a group</h6>
                        <p id="contactProfileStatus">Last seen at 07:15 PM</p>
                    </div>
                    <div class="row gx-3">
                        <div class="col">
                            <a class="action-wrap">
                                <i class="ti ti-phone"></i>
                                <p>Audio</p>
                            </a>
                        </div>
                        <div class="col">
                            <a class="action-wrap">
                                <i class="ti ti-video"></i>
                                <p>Video</p>
                            </a>
                        </div>
                        <div class="col">
                            <a class="action-wrap">
                                <i class="ti ti-brand-hipchat"></i>
                                <p>Chat</p>
                            </a>
                        </div>
                        <div class="col">
                            <a class="action-wrap">
                                <i class="ti ti-search"></i>
                                <p>Search</p>
                            </a>
                        </div>
                    </div>
                    <div class="content-wrapper">
                        <h5 class="sub-title">Profile Info</h5>
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group profile-item">
                                    <li class="list-group-item">
                                        <div class="profile-info">
                                            <h6>Name</h6>
                                            <p id="contactInfoName">Select a group</p>
                                        </div>
                                        <div class="profile-icon">
                                            <i class="ti ti-user-circle"></i>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="info">
                                            <h6>Email Address</h6>
                                            <p id="contactInfoEmail">-</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ti ti-mail-heart"></i>
                                        </div>
                                    </li>
                                     
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="content-wrapper">
                        <h5 class="sub-title">Social Profiles</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="social-icon">
                                    <a href="javascript:void(0);"><i class="ti ti-brand-facebook"></i></a>
                                    <a href="javascript:void(0);"><i class="ti ti-brand-twitter"></i></a>
                                    <a href="javascript:void(0);"><i class="ti ti-brand-instagram"></i></a>
                                    <a href="javascript:void(0);"><i class="ti ti-brand-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="content-wrapper">
                        <h5 class="sub-title">Media Details</h5>
                        <div class="chat-file">
                            <div class="file-item action-wrap">
                                <div class="accordion accordion-flush chat-accordion" id="mediafile">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chatuser-collapse1" aria-expanded="false" aria-controls="chatuser-collapse1">
                                                <i class="ti ti-photo-shield me-2"></i>Photos
                                            </a>
                                        </h2>
                                        <div id="chatuser-collapse1" class="accordion-collapse collapse" data-bs-parent="#mediafile">
                                            <div class="accordion-body">
                                                <div class="chat-user-photo" id="mediaPhotosContainer">
                                                    <div class="text-center p-4">
                                                        <div class="spinner-border text-primary" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        <p class="mt-2 text-muted">Loading photos...</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#media-video" aria-expanded="false" aria-controls="media-video">
                                                <i class="ti ti-video me-2"></i>Videos
                                            </a>
                                        </h2>
                                        <div id="media-video" class="accordion-collapse collapse" data-bs-parent="#mediafile">
                                            <div class="accordion-body">
                                                <div class="chat-video" id="mediaVideosContainer">
                                                    <div class="text-center p-4">
                                                        <div class="spinner-border text-primary" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        <p class="mt-2 text-muted">Loading videos...</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#media-links" aria-expanded="false" aria-controls="media-links">
                                                <i class="ti ti-unlink me-2"></i>Links
                                            </a>
                                        </h2>
                                        <div id="media-links" class="accordion-collapse collapse" data-bs-parent="#mediafile">
                                            <div class="accordion-body">
                                                <div id="mediaLinksContainer">
                                                    <div class="text-center p-4">
                                                        <div class="spinner-border text-primary" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        <p class="mt-2 text-muted">Loading links...</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <a href="#" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#media-document" aria-expanded="false" aria-controls="media-document">
                                                <i class="ti ti-unlink me-2"></i>Documents
                                            </a>
                                        </h2>
                                        <div id="media-document" class="accordion-collapse collapse" data-bs-parent="#mediafile">
                                            <div class="accordion-body">
                                                <div id="mediaDocumentsContainer">
                                                    <div class="text-center p-4">
                                                        <div class="spinner-border text-primary" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        <p class="mt-2 text-muted">Loading documents...</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrapper other-info">
                        <h5 class="sub-title">Common in 4 Groups</h5>
                        <div class="card">
                            <div class="card-body list-group profile-item">
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg bg-skyblue rounded-circle me-2">
                                            GU
                                        </div>
                                        <div class="chat-user-info">
                                            <h6>Gustov _family</h6>
                                            <p>Mark, Elizabeth, Aaron, <span class="text-primary">More...</span></p>
                                        </div>
                                    </div>
                                    <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                </a>
                                <a href="javascript:void(0);" class="list-group-item border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-lg bg-info rounded-circle me-2">
                                            AM
                                        </div>
                                        <div class="chat-user-info">
                                            <h6>AM Technology</h6>
                                            <p>Roper, Deborah, David, <span class="text-primary">More..


                                                    .</span></p>
                                        </div>
                                    </div>
                                    <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                </a>
                                <div class="text-center">
                                    <a href="javascript:void(0);" class="view-all link-primary d-inline-flex align-items-center justify-content-center">
                                        More Groups<i class="ti ti-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrapper other-info mb-0">
                        <h5 class="sub-title">Others</h5>
                        <div class="card mb-0">
                            <div class="card-body list-group profile-item">
                                <a href="javascript:void(0);" class="list-group-item" data-bs-toggle="offcanvas" data-bs-target="#contact-favourite">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-graph me-2 text-default"></i>Favorites</h6>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="badge badge-danger count-message me-1">12</span>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-volume-off me-2 text-warning"></i>Mute Notifications</h6>
                                    </div>
                                    <div>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                                {{-- <a href="javascript:void(0);" class="list-group-item">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-user-off me-2 text-info"></i>Block Users</h6>
                                    </div>
                                    <div>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-user-x me-2 text-purple"></i>Report Users</h6>
                                    </div>
                                    <div>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-chat" class="list-group-item">
                                    <div class="profile-info">
                                        <h6><i class="ti ti-trash me-2 text-danger"></i>Delete Chat</h6>
                                    </div>
                                    <div>
                                        <span class="link-icon"><i class="ti ti-chevron-right"></i></span>
                                    </div>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Contact Info -->
    <!-- New Chat -->
    <div class="modal fade" id="new-chat">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Chat</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{url('chat')}}">
                        <div class="search-wrap contact-search mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <a href="javascript:void(0);" class="input-group-text"><i class="ti ti-search"></i></a>
                            </div>
                        </div>
                        <h6 class="mb-3 fw-medium fs-16">Contacts</h6>
                        <div class="contact-scroll contact-select mb-3">
                            <div class="contact-user d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="ms-2">
                                        <h6>Aaryian Jose</h6>
                                        <p>App Developer</p>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="contact">
                                </div>
                            </div>
                            <div class="contact-user d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-02.jpg')}}" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="ms-2">
                                        <h6>Sarika Jain</h6>
                                        <p>UI/UX Designer</p>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="contact">
                                </div>
                            </div>
                            <div class="contact-user d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-03.jpg')}}" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="ms-2">
                                        <h6>Clyde Smith</h6>
                                        <p>Web Developer</p>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="contact">
                                </div>
                            </div>
                            <div class="contact-user d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg">
                                        <img src="{{URL::asset('/build/img/profiles/avatar-04.jpg')}}" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="ms-2">
                                        <h6>Carla Jenkins</h6>
                                        <p>Business Analyst</p>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="contact">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">Start Chat</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /New Chat -->
    <!-- Video Call Modal -->
    <div class="modal fade" id="video-call" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center border-0">
                    <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                        <i class="ti ti-video"></i>
                    </span>
                    <h4 class="modal-title">Video Calling...</h4>
                </div>
                <div class="modal-body pb-0">
                    <div class="card bg-light mb-0">
                        <div class="card-body d-flex justify-content-center">
                            <div>
                                <span class="avatar avatar-xxl">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg') }}" class="rounded-circle" alt="user">
                                </span>
                                <h6 class="fs-14 mt-2">Edward Lietz</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <!-- Replaces direct modal trigger with JS -->
                    <a href="javascript:void(0);" onclick="openStartVideoCall()" class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2">
                        <i class="ti ti-phone fs-20"></i>
                    </a>
                    <a href="javascript:void(0);" class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-phone-off fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Voice Call Modal -->
<div class="modal fade" id="voice_call" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center border-0">
                <span class="model-icon bg-primary d-flex justify-content-center align-items-center rounded-circle me-2">
                    <i class="ti ti-phone-call"></i>
                </span>
                <h4 class="modal-title">Audio Calling...</h4>
            </div>
            <div class="modal-body pb-0">
                <div class="card bg-light mb-0">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <span class="avatar avatar-xxl">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <h6 class="fs-14">Edward Lietz</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <!-- Attend button -->
                <a href="javascript:void(0);"
                    class="voice-icon btn btn-success rounded-circle d-flex justify-content-center align-items-center me-2"
                    data-bs-dismiss="modal"
                    onclick="setTimeout(() => { new bootstrap.Modal(document.getElementById('voice_attend')).show(); }, 300);">
                    <i class="ti ti-phone fs-20"></i>
                </a>

                <!-- Cancel button -->
                <a href="javascript:void(0);"
                    class="voice-icon btn btn-danger rounded-circle d-flex justify-content-center align-items-center"
                    data-bs-dismiss="modal">
                    <i class="ti ti-phone-off fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Voice Call Attend Modal -->
<div class="modal fade" id="voice_attend" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex border-0 pb-0">
                <div class="card bg-transparent-dark flex-fill border mb-3">
                    <div class="card-body d-flex justify-content-between p-3 flex-wrap row-gap-3">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg online me-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                            <div>
                                <h6>Edward Lietz</h6>
                                <span>+22-555-345-11</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge border border-primary text-primary badge-sm me-2">
                                <i class="ti ti-point-filled"></i> 01:15:25
                            </span>
                            <a href="javascript:void(0);" class="user-add bg-primary rounded d-flex justify-content-center align-items-center text-white">
                                <i class="ti ti-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body border-0 pt-0">
                <div class="card audio-crd bg-transparent-dark border">
                    <div class="modal-bgimg">
                        <span class="modal-bg1">
                            <img src="{{ URL::asset('/build/img/bg/bg-02.png')}}" class="img-fluid" alt="bg">
                        </span>
                        <span class="modal-bg2">
                            <img src="{{ URL::asset('/build/img/bg/bg-03.png')}}" class="img-fluid" alt="bg">
                        </span>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-center align-items-center pt-5">
                            <span class="avatar avatar-xxxl bg-soft-primary rounded-circle p-2">
                                <img src="{{ URL::asset('/build/img/profiles/avatar-06.jpg')}}" class="rounded-circle" alt="user">
                            </span>
                        </div>
                        <div class="d-flex align-items-end justify-content-end">
                            <span class="call-span border border-2 border-primary d-flex justify-content-center align-items-center rounded">
                                <span class="avatar avatar-xl bg-soft-primary rounded-circle p-2">
                                    <img src="{{ URL::asset('/build/img/profiles/avatar-17.jpg')}}" class="rounded-circle" alt="user">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center border-0 pt-0">
                <div class="call-controll-block d-flex align-items-center justify-content-center rounded-pill">
                    <a href="javascript:void(0);" class="call-controll mute-bt d-flex align-items-center justify-content-center">
                        <i class="ti ti-microphone"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-volume"></i>
                    </a>

                    <!-- End Call -->
                    <a href="javascript:void(0);" data-bs-dismiss="modal" class="call-controll call-decline d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </a>

                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-maximize"></i>
                    </a>
                    <a href="javascript:void(0);" class="call-controll d-flex align-items-center justify-content-center">
                        <i class="ti ti-dots"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @component('components.model-popup')
    @endcomponent
</div>



<!-- New Group -->
<div class="modal fade" id="new-group">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Group</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('index')}}">
                    <div class="d-flex justify-content-center align-items-center">
                        <label for="avatar-upload" class="set-pro avatar avatar-xxl rounded-circle mb-3 p-1">
                            <span class="avatar avatar-xl bg-transparent-dark rounded-circle"></span>
                            <span class="add avatar avatar-sm d-flex justify-content-center align-items-center">
                                <i class="ti ti-plus rounded-circle d-flex justify-content-center align-items-center"></i>
                            </span>
                        </label>
                        <input type="file" id="avatar-upload" style="display: none;" accept="image/*">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label">Group Name</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control" placeholder="First Name">
                                <span class="icon-addon">
                                    <i class="ti ti-users-group"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">About</label>
                            <div class="input-icon mb-3 position-relative">
                                <input type="text" value="" class="form-control" placeholder="Last Name">
                                <span class="icon-addon">
                                    <i class="ti ti-info-octagon"></i>
                                </span>
                            </div>
                        </div>
                        <label class="form-label">Group Type</label>
                        <div class="d-flex">

                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="mute" id="group1">
                                <label class="form-check-label" for="group1">Public</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="mute" id="group2">
                                <label class="form-check-label" for="group2">Private</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add-group">Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /New Group -->

<script>
    const toggleIcon = document.getElementById("toggleIcon");
    const chevron = document.getElementById("chevronIcon");

    if (toggleIcon && chevron) {
        toggleIcon.addEventListener("click", () => {
            setTimeout(() => {
                chevron.classList.toggle("ti-chevron-down");
                chevron.classList.toggle("ti-chevron-up");
            }, 150);
        });
    }
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const body = document.body;
        const darkBtn = document.getElementById('dark-mode-toggle');
        const lightBtn = document.getElementById('light-mode-toggle');

        if (darkBtn && lightBtn) {
            darkBtn.addEventListener('click', function(e) {
                e.preventDefault();
                body.classList.add('dark-mode');
                darkBtn.style.display = 'none';
                lightBtn.style.display = 'inline';
            });

            lightBtn.addEventListener('click', function(e) {
                e.preventDefault();
                body.classList.remove('dark-mode');
                lightBtn.style.display = 'none';
                darkBtn.style.display = 'inline';
            });
        }
    });
</script>

<!-- Bootstrap JS Bundle (includes Popper) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

@component('components.model-popup')
@endcomponent

<!-- Agora Chat SDK -->
<script src="https://download.agora.io/sdk/release/AgoraChat-sdk-Web.js"></script>

<!-- Pass current user ID to JS -->
@php
    $currentUser = Auth::user();
    $avatarUrl = asset('build/img/profiles/avatar-17.jpg');
    
    if ($currentUser) {
        // Check image field first (stored in public/upload/users/) for consistency
        if (!empty($currentUser->image)) {
            // Check if path starts with upload/ (public directory) or use storage/
            if (strpos($currentUser->image, 'upload/') === 0) {
                $avatarUrl = asset($currentUser->image);
            } else {
                $avatarUrl = asset('storage/' . $currentUser->image);
            }
        }
        // Fallback to profile_image (stored in storage/app/public/profiles/)
        elseif (!empty($currentUser->profile_image)) {
            $avatarUrl = asset('storage/' . $currentUser->profile_image);
        }
    }
@endphp
<script>
    window.currentUserId = "{{ (string)Auth::id() }}";
    window.currentUserAvatar = "{{ $avatarUrl }}";
</script>

<!-- Group Chat Manager -->
<script src="{{ asset('js/group-chat.js') }}"></script>

<script>
    // CRITICAL: Prevent default browser behavior for file drops (opening in new tab)
    // Must be set up IMMEDIATELY and at multiple levels
    (function() {
        // Function to check if dragging files
        function hasFiles(e) {
            if (!e.dataTransfer || !e.dataTransfer.types) return false;
            const types = Array.from(e.dataTransfer.types);
            return types.some(type => 
                type === 'Files' || 
                type === 'application/x-moz-file' ||
                type.indexOf('File') !== -1
            );
        }
        
        // Prevent default on dragover - CRITICAL: must be called for drop to work
        function preventFileDrag(e) {
            if (hasFiles(e)) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                if (e.dataTransfer) {
                    e.dataTransfer.dropEffect = 'none';
                }
                return false;
            }
        }
        
        // Prevent default on drop - CRITICAL: stops browser from opening file
        // But don't stop propagation so dropZone handler can process it
        function preventFileDrop(e) {
            if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                // Always prevent default to stop browser from opening file
                e.preventDefault();
                // Don't stop propagation - let dropZone handler process it
                return false;
            }
        }
        
        // Add handlers at document level with capture phase (catches events first)
        document.addEventListener('dragover', preventFileDrag, true);
        document.addEventListener('dragenter', preventFileDrag, true);
        document.addEventListener('drop', preventFileDrop, true);
        
        // Also add at window level
        window.addEventListener('dragover', preventFileDrag, true);
        window.addEventListener('dragenter', preventFileDrag, true);
        window.addEventListener('drop', preventFileDrop, true);
        
        // Additional: Add to body as soon as it exists
        if (document.body) {
            document.body.addEventListener('dragover', preventFileDrag, true);
            document.body.addEventListener('dragenter', preventFileDrag, true);
            document.body.addEventListener('drop', preventFileDrop, true);
        } else {
            // Wait for body to be ready
            const observer = new MutationObserver(function(mutations) {
                if (document.body) {
                    document.body.addEventListener('dragover', preventFileDrag, true);
                    document.body.addEventListener('dragenter', preventFileDrag, true);
                    document.body.addEventListener('drop', preventFileDrop, true);
                    observer.disconnect();
                }
            });
            observer.observe(document.documentElement, { childList: true });
        }
        
        // Prevent navigation that might be triggered by file drops
        window.addEventListener('beforeunload', function(e) {
            // This won't prevent the drop, but helps with debugging
        }, false);
        
        // Additional: Prevent any link-like behavior from file drops
        document.addEventListener('click', function(e) {
            // If clicking happened right after a drop, prevent default navigation
            if (window.justDroppedFile) {
                e.preventDefault();
                e.stopPropagation();
                window.justDroppedFile = false;
            }
        }, true);
    })();

    // Initialize group chat on page load
    document.addEventListener('DOMContentLoaded', () => {
        // Pre-define common elements to avoid scoping issues
        const chatFooter = document.querySelector('.chat-footer');
        const chatBody = document.querySelector('.chat-body');
        const chatContainer = document.querySelector('.main-chat-blk') || document.querySelector('.chat');
        const messageInput = document.querySelector('.chat-footer-wrap .form-control');
        const fileInput = document.getElementById('files');

        // Initialize Agora Chat
        if (window.groupChatManager) {
            // Start unread badge polling immediately (even before Agora initializes)
            if (typeof window.groupChatManager.startUnreadBadgePolling === 'function') {
                window.groupChatManager.startUnreadBadgePolling();
            }
            
            window.groupChatManager.initAgora().then(() => {
                // Check if group ID is in URL parameter
                const urlParams = new URLSearchParams(window.location.search);
                const groupIdParam = urlParams.get('group');
                
                if (groupIdParam) {
                    // Find the group from the groups array
                    @if(isset($groups) && count($groups) > 0)
                        @php
                            // Find group by ID in PHP
                            $selectedGroup = null;
                            if (isset($_GET['group'])) {
                                $requestedGroupId = $_GET['group'];
                                foreach ($groups as $group) {
                                    if ((string)$group['id'] === (string)$requestedGroupId) {
                                        $selectedGroup = $group;
                                        break;
                                    }
                                }
                            }
                        @endphp
                        
                        @if($selectedGroup)
                            // Open the selected group
                            window.groupChatManager.openGroupChat('{{ $selectedGroup['id'] }}', '{{ addslashes($selectedGroup['name']) }}', '{{ $selectedGroup['team_photo'] }}');
                        @else
                            // Group not found, open first group as fallback
                            @php $firstGroup = $groups[0]; @endphp
                            window.groupChatManager.openGroupChat('{{ $firstGroup['id'] }}', '{{ addslashes($firstGroup['name']) }}', '{{ $firstGroup['team_photo'] }}');
                        @endif
                    @else
                        // No groups available
                        console.log('No groups available');
                    @endif
                } else {
                    // No group parameter, open first group
                    @if(isset($groups) && count($groups) > 0)
                        @php $firstGroup = $groups[0]; @endphp
                        window.groupChatManager.openGroupChat('{{ $firstGroup['id'] }}', '{{ addslashes($firstGroup['name']) }}', '{{ $firstGroup['team_photo'] }}');
                    @endif
                }
            });
        }
        
        // Store selected file for sending
        window.selectedFile = null;
        window.selectedFileType = null;
        
        // Handle file input for file sharing
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) {
                    window.selectedFile = null;
                    window.selectedFileType = null;
                    removeFilePreview();
                    return;
                }
                
                if (!window.groupChatManager || !window.groupChatManager.currentGroupId) {
                    alert('Please select a group first');
                    fileInput.value = '';
                    window.selectedFile = null;
                    window.selectedFileType = null;
                    return;
                }
                
                // Determine message type based on file type
                let messageType = 'file';
                const fileType = file.type.toLowerCase();
                
                if (fileType.startsWith('image/')) {
                    messageType = 'img';
                } else if (fileType.startsWith('audio/')) {
                    messageType = 'audio';
                } else if (fileType.startsWith('video/')) {
                    messageType = 'video';
                } else {
                    messageType = 'file';
                }
                
                // Store file for later sending
                window.selectedFile = file;
                window.selectedFileType = messageType;
                
                // Show file preview
                showFilePreview(file, messageType);
            });
        }
        
        // Function to show file preview
        function showFilePreview(file, messageType) {
            // Remove existing preview if any
            removeFilePreview();
            
            // Wait a bit to ensure DOM is ready
            setTimeout(() => {
                const formWrap = document.querySelector('.chat-footer-wrap .form-wrap');
                if (!formWrap) {
                    console.warn('Form wrap not found, retrying...');
                    // Retry after a short delay
                    setTimeout(() => {
                        const retryFormWrap = document.querySelector('.chat-footer-wrap .form-wrap');
                        if (!retryFormWrap) {
                            console.error('Form wrap not found after retry');
                            return;
                        }
                        insertPreview(retryFormWrap, file, messageType);
                    }, 200);
                    return;
                }
                
                insertPreview(formWrap, file, messageType);
            }, 50);
        }
        
        function insertPreview(formWrap, file, messageType) {
            const preview = document.createElement('div');
            preview.id = 'filePreview';
            preview.className = 'file-preview mb-2 p-2 bg-light rounded d-flex align-items-center justify-content-between';
            preview.style.cssText = 'border: 1px solid #ddd; margin-bottom: 8px;';
            
            // For images, show thumbnail preview (WhatsApp style - just image, no filename)
            if (messageType === 'img') {
                // Show loading placeholder immediately
                preview.innerHTML = `
                    <div class="d-flex align-items-center justify-content-between" style="position: relative;">
                        <div style="width: 50px; height: 50px; border-radius: 4px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                            <i class="ti ti-photo" style="font-size: 24px; color: #999;"></i>
                        </div>
                        <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeFilePreview(); document.getElementById('files').value = ''; window.selectedFile = null; window.selectedFileType = null;" style="font-size: 12px; position: absolute; top: -3px; right: -3px; background: white; border-radius: 50%; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.2); padding: 0;">
                            <i class="ti ti-x" style="font-size: 9px;"></i>
                        </button>
                    </div>
                `;
                
                // Insert preview immediately so it doesn't disappear
                if (formWrap && formWrap.parentNode) {
                    formWrap.parentNode.insertBefore(preview, formWrap);
                }
                
                // Then load the actual image
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Check if preview still exists before updating
                    const existingPreview = document.getElementById('filePreview');
                    if (!existingPreview) {
                        console.warn('Preview was removed before FileReader completed');
                        return;
                    }
                    existingPreview.innerHTML = `
                        <div class="d-flex align-items-center justify-content-between" style="position: relative;">
                            <img src="${e.target.result}" alt="Preview" style="width: 50px; height: 50px; border-radius: 4px; object-fit: cover;">
                            <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeFilePreview(); document.getElementById('files').value = ''; window.selectedFile = null; window.selectedFileType = null;" style="font-size: 12px; position: absolute; top: -3px; right: -3px; background: white; border-radius: 50%; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.2); padding: 0;">
                                <i class="ti ti-x" style="font-size: 9px;"></i>
                            </button>
                        </div>
                    `;
                };
                reader.onerror = function() {
                    console.error('FileReader error');
                    const existingPreview = document.getElementById('filePreview');
                    if (existingPreview) {
                        existingPreview.innerHTML = `
                            <div class="d-flex align-items-center justify-content-between" style="position: relative;">
                                <div style="width: 50px; height: 50px; border-radius: 4px; background: #fee; display: flex; align-items: center; justify-content: center;">
                                    <i class="ti ti-alert-circle" style="font-size: 24px; color: #dc3545;"></i>
                                </div>
                                <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeFilePreview(); document.getElementById('files').value = ''; window.selectedFile = null; window.selectedFileType = null;" style="font-size: 12px; position: absolute; top: -3px; right: -3px; background: white; border-radius: 50%; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.2); padding: 0;">
                                    <i class="ti ti-x" style="font-size: 9px;"></i>
                                </button>
                            </div>
                        `;
                    }
                };
                reader.readAsDataURL(file);
            } else {
                // For other file types, show icon
                let icon = '<i class="ti ti-file"></i>';
                if (messageType === 'audio') icon = '<i class="ti ti-music"></i>';
                else if (messageType === 'video') icon = '<i class="ti ti-video"></i>';
                
                preview.innerHTML = `
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="me-2" style="font-size: 20px;">${icon}</span>
                            <div>
                                <div style="font-weight: 500; font-size: 14px;">${file.name}</div>
                                <div style="font-size: 12px; color: #666;">${formatFileSize(file.size)}</div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeFilePreview(); document.getElementById('files').value = ''; window.selectedFile = null; window.selectedFileType = null;" style="font-size: 18px;">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                `;
                
                // Insert preview before formWrap for non-image files
                if (formWrap && formWrap.parentNode) {
                    formWrap.parentNode.insertBefore(preview, formWrap);
                } else {
                    console.error('Cannot insert preview: formWrap or parentNode not found');
                }
            }
        }
        
        // Function to remove file preview
        function removeFilePreview() {
            const preview = document.getElementById('filePreview');
            if (preview) {
                preview.remove();
            }
        }

        // Set up drop zone for chat area
        function setupDropZone() {
            // Use body as primary drop zone to catch all drops
            const dropZone = document.body;
            
            if (!dropZone) {
                // Retry after a short delay if body isn't ready
                setTimeout(setupDropZone, 500);
                return;
            }
            
            let dragCounter = 0;
            
            // CRITICAL: Prevent default on dragover - this is required for drop to work
            dropZone.addEventListener('dragover', function(e) {
                if (e.dataTransfer && e.dataTransfer.types) {
                    const types = Array.from(e.dataTransfer.types);
                    const hasFiles = types.some(type => 
                        type === 'Files' || 
                        type === 'application/x-moz-file' ||
                        type.indexOf('File') !== -1
                    );
                    
                    if (hasFiles) {
                        e.preventDefault();
                        e.stopPropagation();
                        e.dataTransfer.dropEffect = 'copy';
                        
                        // Visual feedback only if over chat area
                        const chatArea = e.target.closest('.chat-body, .chat-footer, .main-chat-blk, .chat, .chat-page-group');
                        if (chatArea) {
                            chatArea.classList.add('drag-over');
                            if (chatContainer) chatContainer.classList.add('drag-over');
                        }
                        return false;
                    }
                }
            }, false);
            
            dropZone.addEventListener('dragenter', function(e) {
                if (e.dataTransfer && e.dataTransfer.types) {
                    const types = Array.from(e.dataTransfer.types);
                    const hasFiles = types.some(type => 
                        type === 'Files' || 
                        type === 'application/x-moz-file' ||
                        type.indexOf('File') !== -1
                    );
                    
                    if (hasFiles) {
                        e.preventDefault();
                        e.stopPropagation();
                        dragCounter++;
                        
                        // Visual feedback only if over chat area
                        const chatArea = e.target.closest('.chat-body, .chat-footer, .main-chat-blk, .chat, .chat-page-group');
                        if (chatArea) {
                            chatArea.classList.add('drag-over');
                            if (chatContainer) chatContainer.classList.add('drag-over');
                        }
                        return false;
                    }
                }
            }, false);
            
            dropZone.addEventListener('dragleave', function(e) {
                if (e.dataTransfer && e.dataTransfer.types) {
                    const types = Array.from(e.dataTransfer.types);
                    const hasFiles = types.some(type => 
                        type === 'Files' || 
                        type === 'application/x-moz-file' ||
                        type.indexOf('File') !== -1
                    );
                    
                    if (hasFiles) {
                        dragCounter--;
                        if (dragCounter <= 0) {
                            dragCounter = 0;
                            document.querySelectorAll('.drag-over').forEach(el => el.classList.remove('drag-over'));
                        }
                    }
                }
            }, false);
            
            // Handle dropped files
            // Use capture phase to handle before other handlers
            dropZone.addEventListener('drop', function(e) {
                // CRITICAL: Check for files FIRST and prevent default IMMEDIATELY
                const dt = e.dataTransfer;
                if (dt && dt.files && dt.files.length > 0) {
                    // PREVENT DEFAULT IMMEDIATELY - before anything else
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    
                    // Mark that we just dropped a file to prevent any navigation
                    window.justDroppedFile = true;
                    setTimeout(function() {
                        window.justDroppedFile = false;
                    }, 1000);
                }
                
                dragCounter = 0;
                document.querySelectorAll('.drag-over').forEach(el => el.classList.remove('drag-over'));
                
                if (!dt || !dt.files || dt.files.length === 0) {
                    return;
                }
                
                const files = dt.files;
                
                // Only handle if drop is in chat area (when using body as drop zone)
                const chatArea = e.target.closest('.chat-body, .chat-footer, .main-chat-blk, .chat, .chat-page-group');
                if (!chatArea) {
                    // Not in chat area, just prevent default and return
                    return;
                }
                
                // Check if group is selected
                if (!window.groupChatManager || !window.groupChatManager.currentGroupId) {
                    alert('Please select a group first');
                    return;
                }
                
                // Handle the first file
                const file = files[0];
                
                if (!file) {
                    return;
                }
                
                // Determine message type based on file type
                let messageType = 'file';
                const fileType = file.type ? file.type.toLowerCase() : '';
                const fileName = file.name ? file.name.toLowerCase() : '';
                
                if (fileType.startsWith('image/') || /\.(jpg|jpeg|png|gif|bmp|webp|svg)$/i.test(fileName)) {
                    messageType = 'img';
                } else if (fileType.startsWith('audio/') || /\.(mp3|wav|ogg|m4a)$/i.test(fileName)) {
                    messageType = 'audio';
                } else if (fileType.startsWith('video/') || /\.(mp4|avi|mov|wmv|flv|webm)$/i.test(fileName)) {
                    messageType = 'video';
                } else {
                    messageType = 'file';
                }
                
                // Store file for later sending
                window.selectedFile = file;
                window.selectedFileType = messageType;
                
                // Show file preview
                if (typeof showFilePreview === 'function') {
                    showFilePreview(file, messageType);
                }
                
                // Focus on message input so user can type a message with the file
                if (messageInput) {
                    messageInput.focus();
                }
            }, false);
        }
        
        // Initialize drop zone
        setupDropZone();
        
        // Also prevent default drag behavior on the message input to allow text selection
        if (messageInput) {
            messageInput.addEventListener('dragover', function(e) {
                // Allow file drops on input too
                if (e.dataTransfer && e.dataTransfer.types) {
                    const hasFiles = Array.from(e.dataTransfer.types).some(type => type === 'Files' || type === 'application/x-moz-file');
                    if (hasFiles) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                }
            }, false);
            
            messageInput.addEventListener('drop', function(e) {
                // If files are dropped, prevent default and let parent handle it
                if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    // The parent drop handler will handle the file
                    return false;
                }
                
                // Allow text drag and drop within the input
                const text = e.dataTransfer.getData('text/plain');
                if (text) {
                    e.preventDefault();
                    const start = this.selectionStart || 0;
                    const end = this.selectionEnd || 0;
                    const currentText = this.value;
                    this.value = currentText.substring(0, start) + text + currentText.substring(end);
                    this.setSelectionRange(start + text.length, start + text.length);
                }
            }, false);
        }
        
        // Make removeFilePreview available globally
        window.removeFilePreview = removeFilePreview;
        
        // Handle paste event for images (messageInput already defined above)
        if (messageInput) {
            messageInput.addEventListener('paste', async function(e) {
                // Check if clipboard contains image
                const items = e.clipboardData?.items;
                if (!items) return;
                
                // Find image in clipboard items
                let hasImage = false;
                for (let i = 0; i < items.length; i++) {
                    const item = items[i];
                    
                    // Check if item is an image
                    if (item.type.indexOf('image') !== -1) {
                        hasImage = true;
                        // Prevent default only for the image, but allow text to paste
                        // We'll handle the image separately
                        
                        // Check if group is selected
                        if (!window.groupChatManager || !window.groupChatManager.currentGroupId) {
                            alert('Please select a group first');
                            // Don't prevent default, let text paste if any
                            return;
                        }
                        
                        // Get image as blob
                        const blob = item.getAsFile();
                        if (!blob) continue;
                        
                        // Prevent default to stop image from being pasted as text
                        e.preventDefault();
                        
                        // Create a File object from the blob
                        const fileName = 'pasted-image-' + Date.now() + '.png';
                        const file = new File([blob], fileName, { type: blob.type });
                        
                        // Determine message type
                        let messageType = 'img';
                        if (blob.type.startsWith('image/')) {
                            messageType = 'img';
                        } else if (blob.type.startsWith('audio/')) {
                            messageType = 'audio';
                        } else if (blob.type.startsWith('video/')) {
                            messageType = 'video';
                        } else {
                            messageType = 'file';
                        }
                        
                        // Store file for later sending
                        window.selectedFile = file;
                        window.selectedFileType = messageType;
                        
                        // Show file preview
                        showFilePreview(file, messageType);
                        
                        // Get any text from clipboard and paste it manually
                        const textData = e.clipboardData.getData('text/plain');
                        if (textData && textData.trim()) {
                            // Insert text at cursor position
                            const start = messageInput.selectionStart || 0;
                            const end = messageInput.selectionEnd || 0;
                            const currentText = messageInput.value;
                            const newText = currentText.substring(0, start) + textData + currentText.substring(end);
                            messageInput.value = newText;
                            
                            // Set cursor position after pasted text
                            const newCursorPos = start + textData.length;
                            messageInput.setSelectionRange(newCursorPos, newCursorPos);
                        }
                        
                        // Keep focus on input so user can continue typing
                        messageInput.focus();
                        
                        break; // Only handle first image
                    }
                }
                // If no image found, let default paste behavior happen (for text)
            });
        }
        
        // Function to format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }
        
        // Make file input clickable via the folder icon
        const fileAction = document.querySelector('.file-action');
        if (fileAction && fileInput) {
            fileAction.addEventListener('click', function(e) {
                e.preventDefault();
                fileInput.click();
            });
        }

        // Global safeguard for auto-scroll on initial load
        window.addEventListener('load', () => {
            if (window.groupChatManager) {
                // Brute force scroll several times after page fully loads
                [100, 500, 1000, 2000, 3000].forEach(delay => {
                    setTimeout(() => {
                        window.groupChatManager.forceScrollToBottom();
                    }, delay);
                });
            }
        });

        // Close emoji pickers when clicking outside
        document.addEventListener('click', (e) => {
            // Check if click is outside emoji picker
            if (!e.target.closest('.emoj-action') && !e.target.closest('.emoj-group-list')) {
                document.querySelectorAll('.emoj-group-list').forEach(list => {
                    list.style.display = 'none';
                    list.classList.remove('emoji-picker-shown');
                });
            }
        });

        // Load favorites when favorites offcanvas is opened
        // Use setTimeout to ensure DOM is ready
        setTimeout(() => {
            const favoritesOffcanvas = document.getElementById('contact-favourite');
            if (favoritesOffcanvas) {
                favoritesOffcanvas.addEventListener('show.bs.offcanvas', () => {
                    if (window.groupChatManager && typeof window.groupChatManager.loadFavorites === 'function') {
                        window.groupChatManager.loadFavorites(window.groupChatManager.currentGroupId).catch(err => {
                            console.error('Failed to load favorites:', err);
                        });
                    }
                });
            }
        }, 500);
    });

    // Todo Modal JavaScript Handlers
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize selectedUsers if not exists
        if (!window.selectedUsers) {
            window.selectedUsers = [];
        }

        // Priority buttons
        const priorityLow = document.getElementById('priorityLow');
        const priorityMiddle = document.getElementById('priorityMiddle');
        const priorityHigh = document.getElementById('priorityHigh');
        
        if (priorityLow) {
            priorityLow.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('priorityHidden').value = 'low';
                document.querySelector('#priorityMiddle')?.classList.remove('active', 'active1');
                document.querySelector('#priorityHigh')?.classList.remove('active', 'active1');
                document.querySelector('#priorityLow')?.classList.add('active', 'active1');
                document.querySelectorAll('#priorityLow, #priorityMiddle, #priorityHigh').forEach(b => {
                    b.style.backgroundColor = '';
                    b.style.color = '';
                });
                if (this) {
                    this.style.backgroundColor = '#22c55e';
                    this.style.color = 'white';
                }
            });
        }
        
        if (priorityMiddle) {
            priorityMiddle.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('priorityHidden').value = 'middle';
                document.querySelector('#priorityHigh')?.classList.remove('active', 'active1');
                document.querySelector('#priorityLow')?.classList.remove('active', 'active1');
                document.querySelector('#priorityMiddle')?.classList.add('active', 'active1');
                document.querySelectorAll('#priorityLow, #priorityMiddle, #priorityHigh').forEach(b => {
                    b.style.backgroundColor = '';
                    b.style.color = '';
                });
                if (this) {
                    this.style.backgroundColor = '#22c55e';
                    this.style.color = 'white';
                }
            });
        }
        
        if (priorityHigh) {
            priorityHigh.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('priorityHidden').value = 'high';
                document.querySelector('#priorityMiddle')?.classList.remove('active', 'active1');
                document.querySelector('#priorityLow')?.classList.remove('active', 'active1');
                document.querySelector('#priorityHigh')?.classList.add('active', 'active1');
                document.querySelectorAll('#priorityLow, #priorityMiddle, #priorityHigh').forEach(b => {
                    b.style.backgroundColor = '';
                    b.style.color = '';
                });
                if (this) {
                    this.style.backgroundColor = '#22c55e';
                    this.style.color = 'white';
                }
            });
        }

        // Reminder buttons
        document.querySelectorAll('.reminder-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.reminder-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('reminderHidden').value = this.dataset.value;
            });
        });

        // Time buttons
        document.querySelectorAll('.time-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.time-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('timeHidden').value = this.dataset.value;
            });
        });

        // Sections add/remove
        const sectionsWrapper = document.getElementById('sectionsWrapper');
        if (sectionsWrapper) {
            sectionsWrapper.addEventListener('click', function(e) {
                const addButton = e.target.closest('.add-btn');
                const removeButton = e.target.closest('.remove-btn');

                if (addButton) {
                    const div = document.createElement('div');
                    div.className = 'col-md-12 d-flex align-items-center section-item mt-2';
                    div.innerHTML = `
                        <input name="sections[]" type="text" class="form-control" placeholder="Section Description"
                               style="font-size: 13px; background-color: white; border-radius: 8px;">
                        <button type="button" class="btn btn-minus btn-sm ms-2 remove-btn"><span>-</span></button>
                    `;
                    sectionsWrapper.appendChild(div);
                }

                if (removeButton) {
                    removeButton.closest('.section-item').remove();
                }
            });
        }

        // User selection handlers
        document.querySelectorAll('.user_div').forEach(div => {
            div.addEventListener('click', function() {
                let userId = this.getAttribute('data-user-id');
                let isPrivate = document.getElementById('todo_visibility')?.value === 'private' || 
                               document.getElementById('isPrivateHidden')?.value === '1';
                
                if (isPrivate) {
                    document.querySelectorAll('.user_div').forEach(d => d.classList.remove('user_active'));
                    const membersSelect = document.getElementById('members');
                    if (membersSelect) {
                        membersSelect.querySelectorAll('option').forEach(opt => opt.selected = false);
                    }
                    window.selectedUsers = [userId];
                } else {
                    if (this.classList.contains('user_active')) {
                        this.classList.remove('user_active');
                        window.selectedUsers = window.selectedUsers.filter(id => id !== userId);
                        const membersSelect = document.getElementById('members');
                        if (membersSelect) {
                            let option = membersSelect.querySelector(`option[value="${userId}"]`);
                            if (option) option.selected = false;
                        }
                    } else {
                        this.classList.add('user_active');
                        if (!window.selectedUsers.includes(userId)) {
                            window.selectedUsers.push(userId);
                        }
                        const membersSelect = document.getElementById('members');
                        if (membersSelect) {
                            let option = membersSelect.querySelector(`option[value="${userId}"]`);
                            if (option) option.selected = true;
                        }
                    }
                }
                
                const selectedUserInput = document.getElementById('selected_user');
                if (selectedUserInput) {
                    selectedUserInput.value = window.selectedUsers.join(',');
                }
            });
        });

        // Shared/Private toggle handlers
        const btnShared = document.getElementById('btnShared');
        const btnPrivate = document.getElementById('btnPrivate');
        const selectUsersBox = document.getElementById('selectUsersBox');

        if (btnPrivate && selectUsersBox) {
            btnPrivate.addEventListener('click', function() {
                selectUsersBox.style.display = 'none';
                document.querySelectorAll('.user_div.user_active').forEach((el, index) => {
                    if (index > 0) {
                        el.classList.remove('user_active');
                        let userId = el.getAttribute('data-user-id');
                        let membersSelect = document.getElementById('members');
                        if (membersSelect) {
                            let option = membersSelect.querySelector(`option[value='${userId}']`);
                            if (option) option.selected = false;
                        }
                    }
                });
                if (window.selectedUsers && window.selectedUsers.length > 1) {
                    window.selectedUsers = window.selectedUsers.slice(0, 1);
                    const selectedUserInput = document.getElementById('selected_user');
                    if (selectedUserInput) {
                        selectedUserInput.value = window.selectedUsers.join(',');
                    }
                }
            });
        }
        
        if (btnShared && selectUsersBox) {
            btnShared.addEventListener('click', function() {
                selectUsersBox.style.display = 'block';
                if (window.selectedUsers) {
                    window.selectedUsers = [];
                }
            });
        }

        // Today/Scheduled toggle handlers
        const btnToday = document.getElementById('btnToday');
        const btnScheduled = document.getElementById('btnScheduled');
        const timeRow = document.getElementById('timeRow');
        const timeToday = document.getElementById('timeToday');

        if (btnScheduled && timeRow && timeToday) {
            btnScheduled.addEventListener('click', function() {
                timeRow.style.display = 'flex';
                timeToday.style.display = 'none';
            });
        }

        if (btnToday && timeRow && timeToday) {
            btnToday.addEventListener('click', function() {
                timeRow.style.display = 'none';
                timeToday.style.display = 'flex';
            });
        }

        // Save button handler
        const saveBtn = document.getElementById('saveBtn');
        if (saveBtn) {
            saveBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = document.getElementById('todoForm');
                const title = document.getElementById('todo_name')?.value.trim();
                const priorityHidden = document.getElementById('priorityHidden')?.value;
                const reminderHidden = document.getElementById('reminderHidden')?.value;
                const timeHidden = document.getElementById('timeHidden')?.value;
                const todoType = document.getElementById('todo_type')?.value;
                const todoVisibility = document.getElementById('todo_visibility')?.value;

                if (!todoVisibility) {
                    alert("Please select 'Shared ToDo's' or 'Private ToDo's' before submitting.");
                    return;
                }

                if (!todoType) {
                    alert("Please select 'Today ToDo's' or 'Scheduled ToDo's' before submitting.");
                    return;
                }

                if (todoVisibility === 'shared') {
                    const activeUsers = document.querySelectorAll('.user_div.user_active');
                    if (activeUsers.length === 0) {
                        alert('Please select at least one user for Shared ToDo.');
                        return;
                    }
                    const membersSelect = document.getElementById('members');
                    if (membersSelect) {
                        membersSelect.querySelectorAll('option').forEach(opt => opt.selected = false);
                        activeUsers.forEach(userDiv => {
                            const userId = userDiv.getAttribute('data-user-id');
                            const option = membersSelect.querySelector(`option[value="${userId}"]`);
                            if (option) {
                                option.selected = true;
                            }
                        });
                    }
                }

                if (todoType === 'scheduled') {
                    const startDate = document.getElementById('dateInput')?.value;
                    const endDate = document.getElementById('enddateInput')?.value;
                    const endTime = document.getElementById('endTimeSelect')?.value;
                    if (!startDate || !endDate || !endTime) {
                        alert('Please fill all date and time fields for Scheduled ToDo.');
                        return;
                    }
                } else if (!timeHidden) {
                    alert('Please select delivery time for Today ToDo.');
                    return;
                }

                if (!title || !priorityHidden || !reminderHidden) {
                    alert('Please fill all required fields before submitting.');
                    return;
                }

                // Set hidden date/time fields
                const dateInput = document.getElementById('dateInput');
                const enddateInput = document.getElementById('enddateInput');
                const endTimeSelect = document.getElementById('endTimeSelect');
                
                if (dateInput && dateInput.value) {
                    document.getElementById('startDateHidden').value = dateInput.value;
                }
                if (enddateInput && enddateInput.value) {
                    document.getElementById('endDateHidden').value = enddateInput.value;
                }
                if (endTimeSelect && endTimeSelect.value) {
                    document.getElementById('endTimeHidden').value = endTimeSelect.value;
                }

                form.submit();
            });
        }

        // PDF file upload functions
        if (typeof window.createAddPdfFile === 'undefined') {
            window.createAddPdfFile = function() {
                var input = document.createElement('input');
                input.type = 'file';
                input.accept = 'application/pdf, video/mp4, image/png, image/jpeg';
                input.name = 'attachments[]';
                input.style.display = 'none';
                input.addEventListener('change', function() { 
                    if (typeof window.handlePdfSelected === 'function') {
                        window.handlePdfSelected(this, 'create'); 
                    }
                });
                var createPdfInputs = document.getElementById('createPdfInputs');
                if (createPdfInputs) {
                    createPdfInputs.appendChild(input);
                    input.click();
                }
            };
        }

        if (typeof window.handlePdfSelected === 'undefined') {
            window.handlePdfSelected = function(fileInput, mode) {
                if (!fileInput.files || !fileInput.files[0]) return;
                var file = fileInput.files[0];
                var list = mode === 'edit' ? document.getElementById('editPdfList') : document.getElementById('createPdfList');
                if (!list) return;
                var addTile = list.querySelector('.pdf-add-tile');

                var fileType = file.type;
                var iconSrc = '';
                var previewHTML = '';

                if (fileType.includes('pdf')) {
                    iconSrc = 'https://admin.onlinesystems.info/build/img/pdf-icon.svg';
                    previewHTML = `<img src="${iconSrc}" alt="PDF" style="width:20px;height:20px;">`;
                } else if (fileType.includes('image')) {
                    var imageURL = URL.createObjectURL(file);
                    previewHTML = `<img src="${imageURL}" alt="Image" style="width:40px;height:40px;object-fit:cover;border-radius:6px;">`;
                } else if (fileType.includes('video')) {
                    iconSrc = 'https://cdn-icons-png.flaticon.com/512/711/711245.png';
                    previewHTML = `<img src="${iconSrc}" alt="Video" style="width:24px;height:24px;">`;
                }

                var tile = document.createElement('div');
                tile.className = 'd-flex align-items-center gap-2 px-2';
                tile.style.cssText = 'border:1px solid #e5e7eb;border-radius:10px;height:60px;background:#fff;';
                tile.innerHTML =
                    previewHTML +
                    `<div class="d-flex flex-column" style="min-width:100px;">
                        <small style="font-weight:600;">${file.name || 'File'}</small>
                        <small style="color:#6b7280;">${Math.round(file.size / 1024)} KB</small>
                    </div>
                    <button type="button" class="btn" style="color:#ef4444;" onclick="removePdfTile(this)">
                        <i class="ti ti-trash"></i>
                    </button>`;

                if (addTile) list.insertBefore(tile, addTile);
                else list.appendChild(tile);

                tile._fileInput = fileInput;
            };
        }

        if (typeof window.removePdfTile === 'undefined') {
            window.removePdfTile = function(btn) {
                var tile = btn.closest('div');
                if (!tile) return;
                if (tile._fileInput) tile._fileInput.remove();
                tile.remove();
            };
        }
    });
</script>

<!-- SVG Filter for Chat Loader -->
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="position: absolute; width: 0; height: 0;">
    <defs>
        <filter id="goo">
            <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 21 -7"/>
        </filter>
    </defs>
</svg>

<!-- Favourites Offcanvas -->
<div class="chat-offcanvas fav-canvas offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="contact-favourite">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title">
            <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#contact-profile" data-bs-dismiss="offcanvas">
                <i class="ti ti-arrow-left me-2"></i>
            </a>Favourites
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="ti ti-x"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="favourite-chats">
            <div class="text-end mb-4">
                <a href="javascript:void(0);" class="btn btn-light" onclick="window.groupChatManager.clearAllFavorites();">
                    <i class="ti ti-heart-minus me-2"></i>Mark all Unfavourite
                </a>
            </div>
            <div id="favoritesContainer">
                <div class="text-center p-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted">Loading favorites...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Todo Modal -->
@if(isset($projects) && isset($teams) && isset($users))
@include('Todos.todo-modal-partial', ['projects' => $projects, 'teams' => $teams, 'users' => $users])
@endif

@endsection