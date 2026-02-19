<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')

    @php
        $baseUrl = config('https://logiadmin.it-supportline.de/');
    @endphp

    <style>
        /* Global Overrides */
        html, body {
            background-color: #f4f6f8;
            font-family: 'Outfit', sans-serif; /* Assuming a modern font or user default */
            overflow: hidden !important; /* Prevent body scrolling */
            height: 100% !important; /* Constrain body height */
            margin: 0;
            padding: 0;
        }

        /* Main wrapper must be the top-level scroll container */
        .main-wrapper {
            height: 100vh !important;
            max-height: 100vh !important;
            overflow: hidden !important;
            display: flex !important;
            flex-direction: column !important;
            position: relative !important;
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box !important;
            visibility: visible !important; /* Override global hidden */
        }

        /* Main content container - target both classes */
        .content.main_content {
            padding-bottom: 0px !important;
            height: 100% !important; /* Use 100% of parent (main-wrapper) */
            max-height: 100% !important; /* Prevent overflow */
            overflow: hidden !important; /* Prevent main content container from scrolling */
            display: flex !important; /* Ensure flex layout */
            flex: 1 !important;
            min-height: 0 !important; /* Important for flex children */
            position: relative !important;
            box-sizing: border-box !important;
            padding: 0 !important; /* Remove padding that causes overflow */
            margin: 0 !important;
        }

        /* Left Sidebar Navigation - Keep it constrained */
        .content.main_content .sidebar-menu {
            height: 100% !important;
            max-height: 100% !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            flex-shrink: 0 !important;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        /* Chat Header - Reduce Height */
        .chat.chat-messages .chat-header {
            padding: 6px 16px !important;
            min-height: auto !important;
            height: auto !important;
            max-height: 60px !important;
        }

        .chat.chat-messages .chat-header .user-details {
            margin: 0 !important;
            padding: 0 !important;
        }

        .chat.chat-messages .chat-header .avatar.avatar-lg {
            width: 32px !important;
            height: 32px !important;
            min-width: 32px !important;
            min-height: 32px !important;
            flex-shrink: 0 !important;
        }

        .chat.chat-messages .chat-header .user-details .ms-2 {
            margin-left: 8px !important;
        }

        .chat.chat-messages .chat-header .user-details h6 {
            font-size: 14px !important;
            line-height: 1.2 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .chat.chat-messages .chat-header .user-details p {
            font-size: 12px !important;
            line-height: 1.2 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .chat.chat-messages .chat-header .left-icons {
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Header Section */
        .page-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 0 10px;
        }
        .header-title-group {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .header-title {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }
        .task-count-badge {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }

        /* Segmented Control / Filters */
        .filter-tabs {
            display: flex;
            background: #fff;
            padding: 4px;
            border-radius: 8px;
            border: 1px solid #eee;
        }
        .filter-tab {
            padding: 6px 16px;
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .filter-tab:hover {
            color: #1e293b;
            background: #f8fafc;
        }
        .filter-tab.active {
            background: #f1f5f9; /* Light grey/slate active state */
            color: #1e293b;
            font-weight: 600;
        }

        .add-project-btn {
            background-color: #22c55e; /* Green */
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s;
        }
        .add-project-btn:hover {
            background-color: #16a34a;
            color: white;
        }

        /* Stats Cards Row */
        .stats-row {
            display: flex;
            gap: 15px;
            /* overflow-x: auto; */
            padding-bottom: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .stats-card {
            flex: 1;
            min-width: 130px;
            background: #fff;
            border-radius: 16px;
            padding: 15px 10px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.05);
        }
        .stats-icon-wrapper {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 4px;
        }
        .stats-title {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
            white-space: nowrap;
        }
        .stats-count {
            font-size: 20px;
            font-weight: 800;
            color: #1e293b;
        }

        /* Stats Colors based on screenshot approximation */
        .stat-total .stats-icon-wrapper { background-color: #ffe4e6; color: #f43f5e; } /* Pinkish */
        .stat-new .stats-icon-wrapper { background-color: #dbeafe; color: #3b82f6; } /* Blue */
        .stat-progress .stats-icon-wrapper { background-color: #dcfce7; color: #22c55e; } /* Green */
        .stat-hold .stats-icon-wrapper { background-color: #ffedd5; color: #f97316; } /* Orange */
        .stat-checked .stats-icon-wrapper { background-color: #f3e8ff; color: #a855f7; } /* Purple */
        .stat-delayed .stats-icon-wrapper { background-color: #fee2e2; color: #ef4444; } /* Red */
        .stat-rejected .stats-icon-wrapper { background-color: #fce7f3; color: #ec4899; } /* Pink/Magenta */
        .stat-done .stats-icon-wrapper { background-color: #ecfccb; color: #84cc16; } /* Lime */



        /* Main Content Area - Independent Scroll */
        .content.main_content .chat.chat-messages {
            height: 100% !important; /* Use 100% of parent (main_content) */
            max-height: 100% !important; /* Prevent overflow */
            overflow: hidden !important; /* Prevent chat container from scrolling */
            display: flex !important;
            flex-direction: column !important;
            flex: 1 !important;
            min-height: 0 !important; /* Important for flex children to allow shrinking */
            position: relative !important;
            box-sizing: border-box !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Inner chat containers */
        .content.main_content .chat.chat-messages > div {
            display: flex !important;
            flex-direction: column !important;
            height: 100% !important;
            max-height: 100% !important;
            overflow: hidden !important;
            flex: 1 !important;
            min-height: 0 !important;
            box-sizing: border-box !important;
        }

        .content.main_content .chat.chat-messages > div > div {
            flex: 1 !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            min-height: 0 !important;
            -webkit-overflow-scrolling: touch !important;
            box-sizing: border-box !important;
        }

        /* Chat body container */
        .content.main_content .chat-body.chat-page-group {
            padding: 16px !important; /* Reduce padding from 1.5rem */
            margin: 0 auto !important;
            max-width: 1400px !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }

        /* Ticket In Progress Section */
        .section-container {
            max-width: 550px;
            margin: 0 auto;
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background: #fff;
            padding: 15px 20px;
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }
        .section-title {
            color: #22c55e; /* Green title */
            font-weight: 700;
            font-size: 18px;
            font-family: 'Outfit', sans-serif;
        }
        .section-subtitle {
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
            display: block;
            margin-top: 2px;
        }

        .project-select-btn {
            background: #f1f5f9;
            border: none;
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 14px;
            color: #64748b;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .project-select-btn:hover {
            background: #e2e8f0;
            color: #334155;
        }

        /* New Task Card Design */
        .new-task-card {
            background: #fff;
            border-radius: 24px;
            padding: 10px;
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            border: 1px solid #f0f0f0;
            position: relative;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            align-items: center;
        }
        .new-task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        }

        .task-image-col {
            width: 100px;
            height: 100px;
            position: relative;
            /* Custom placeholder pattern similar to screenshot */
            background-color: #e5e5e5;
            background-image:
                linear-gradient(45deg, #d4d4d4 25%, transparent 25%),
                linear-gradient(-45deg, #d4d4d4 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, #d4d4d4 75%),
                linear-gradient(-45deg, transparent 75%, #d4d4d4 75%);
            background-size: 10px 10px;
            background-position: 0 0, 0 5px, 5px -5px, -5px 0px;
            border-radius: 18px;
            flex-shrink: 0;
        }

        .red-index-badge {
            position: absolute;
            top: -8px;
            left: -8px;
            width: 32px;
            height: 32px;
            background-color: #ef4444; /* Red */
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
            z-index: 10;
            border: 3px solid white;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }

        .task-info-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 10px;
            padding-right: 10px;
        }

        .task-header-new {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .task-title-new {
            font-weight: 700;
            color: #334155;
            font-size: 18px;
            text-align: center;
            letter-spacing: -0.5px;
        }

        .status-dot-large {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            border: 4px solid;
        }

        /* Status-specific dot colors matching card status colors */
        .status-dot-large.status-new,
        .status-dot-large[data-status*="new"] {
            background-color: #3b82f6; /* Blue */
            border-color: #dbeafe; /* Light Blue ring */
            box-shadow: 0 0 0 1px #bfdbfe;
        }

        .status-dot-large.status-in_progress,
        .status-dot-large[data-status*="progress"] {
            background-color: #22c55e; /* Green */
            border-color: #dcfce7; /* Light Green ring */
            box-shadow: 0 0 0 1px #bbf7d0;
        }

        .status-dot-large.status-on_hold,
        .status-dot-large[data-status*="hold"] {
            background-color: #f97316; /* Orange */
            border-color: #ffedd5; /* Light Orange ring */
            box-shadow: 0 0 0 1px #fed7aa;
        }

        .status-dot-large.status-checked,
        .status-dot-large[data-status*="checked"] {
            background-color: #a855f7; /* Purple */
            border-color: #f3e8ff; /* Light Purple ring */
            box-shadow: 0 0 0 1px #e9d5ff;
        }

        .status-dot-large.status-delayed,
        .status-dot-large[data-status*="delayed"] {
            background-color: #ef4444; /* Red */
            border-color: #fee2e2; /* Light Red ring */
            box-shadow: 0 0 0 1px #fecaca;
        }

        .status-dot-large.status-rejected,
        .status-dot-large[data-status*="rejected"] {
            background-color: #ec4899; /* Pink/Magenta */
            border-color: #fce7f3; /* Light Pink ring */
            box-shadow: 0 0 0 1px #fbcfe8;
        }

        .status-dot-large.status-done,
        .status-dot-large[data-status*="done"],
        .status-dot-large[data-status*="completed"] {
            background-color: #84cc16; /* Lime */
            border-color: #ecfccb; /* Light Lime ring */
            box-shadow: 0 0 0 1px #d9f99d;
        }

        /* Default fallback for unknown statuses */
        .status-dot-large:not([data-status]):not(.status-new):not(.status-in_progress):not(.status-on_hold):not(.status-checked):not(.status-delayed):not(.status-rejected):not(.status-done) {
            background-color: #f43f5e; /* Pinkish for total/unknown */
            border-color: #ffe4e6; /* Light Pink ring */
            box-shadow: 0 0 0 1px #fecdd3;
        }

        .task-ids-row {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: -5px;
        }

        .id-pill {
            background-color: #e0f2fe; /* Light Blue */
            color: #3b82f6;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .task-desc-new {
            font-size: 13px;
            color: #64748b;
            text-align: center;
            font-weight: 500;
        }

        .date-row-pill {
            background-color: #ecfdf5; /* Light Green */
            color: #10b981; /* Green Text */
            border-radius: 12px;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        .date-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ... existing styles ... */

        /* NEW: Task Detail Modal Specific Styles */
        .task-modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            background: #f8fafc;
        }
        .task-modal-header {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
            padding: 20px 24px;
            position: relative;
            color: white;
        }
        .task-modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            color: white;
            background: rgba(255,255,255,0.2);
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 20;
        }
        .task-project-name {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 2px;
        }
        .task-ticket-name {
            font-size: 12px;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .logo-circle {
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            padding: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .task-modal-body {
            padding: 40px 20px 20px; /* Top padding for logo overlap */
            overflow: visible;
        }

        .modal-task-title {
            font-family: Genos;
            font-weight: 500;
            font-size: 24px;
            line-height: 100%;
            text-align: center;
            color: #1C274C;
            margin-bottom: 10px;
        }

        .modal-tags {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }
        .badge-custom {
            padding: 4px 12px;
            font-family: Genos;
            font-weight: 400;
            font-size: 14px;
            line-height: 14px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            border-radius: 5px;

        }
        .badge-new { background: #e0f2fe; color: #1C274C; font-weight: 500;}
        .badge-id {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        .badge-icon{
            background: #F2F2F2;
            padding: 4px 12px;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }
        .badge-icon i{
            color: #ED1C24;
            font-size: 18px;
        }
        .badge-text{
            background-color: #ED1C24;
            padding: 7px 12px;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        .badge-text span{
            font-family: Genos;
            font-weight: 500;
            font-size: 12px;
            line-height: 12px;
            color: #FFFFFF;
        }
        .badge-low {
            background: #FFFFFF;
            font-family: Genos;
            font-weight: 400;
            font-size: 14px !important;
            line-height: 12px;
            text-align: center;
            padding: 4px 12px;
            border-radius: 5px !important;
            color: #64748B !important;
        }
        .badge-low i{
            color: #1BC469 ;
            font-size: 18px;
        }
        .badge-checked { background: #f3e8ff; color: #a855f7; } /* Purple for checking status */

        .meta-row {
            background: #FFFFFF;
            border-radius: 5px;
            padding: 7px 5px;
            display: flex;
            justify-content: space-around;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 20px;
        }
        .meta-divider {
            width: 2px;
            height: 15px;
            background: #64748B40;     /* light grey line */
            position: relative;
            border-radius: 2px;
}

        .meta-label{
            color: #1BC469 !important;
        }
        .meta-item{
            font-family: Genos;
            font-weight: 500;
            font-size: 15px;
            line-height: 14px;
            color: #1C274C !important;
        }

        .desc-box {
            background: #F2F2F280;
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 15px;
        }
        .desc-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: Genos;
            font-weight: 500;
            font-size: 16px;
            line-height: 100%;
            color: #1C274C;
            margin-bottom: 8px;
        }
        .desc-box p{
            font-family: Genos;
            font-weight: 400;
            font-size: 16px;
            line-height: 19px;
            letter-spacing: 0%;
            text-transform: lowercase;
            color: #1C274C;
        }

        .image-preview-area {
            width: 100%;
            height: 200px;
            background: #e2e8f0;
            border-radius: 16px;
            margin-bottom: 20px;
            overflow: hidden;
            position: relative;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #modalTaskImageFull {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            z-index: 1;
        }

        /* Issue Badge Styles */
        .issue-badge {
            position: absolute;
            width: 28px;
            height: 28px;
            background-color: #22c55e; /* Green */
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 13px;
            cursor: pointer;
            z-index: 1000 !important;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(34, 197, 94, 0.4);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .issue-badge:hover {
            transform: translate(-50%, -50%) scale(1.15) !important;
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.6);
        }

        .issue-badge-highlight {
            position: absolute;
            border: 2px solid #f97316; /* Orange */
            border-radius: 8px;
            pointer-events: none;
            z-index: 9;
        }

        #issueBadgesContainer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 100;
            pointer-events: none;
            overflow: visible;
        }

        #issueBadgesContainer .issue-badge-wrapper {
            pointer-events: all;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Issue Detail Modal Backdrop - Light Gray */
        .modal-backdrop.show {
            opacity: 0.5;
            transition: background-color 0.15s linear;
        }

        /* Custom backdrop for issue detail modal - light gray */
        .issue-modal-backdrop,
        body.modal-open .modal-backdrop.show.issue-modal-backdrop {
            background-color: rgba(148, 163, 184, 0.75) !important;
            opacity: 1 !important;
        }

        /* Notes List */
        .notes-section {
            margin-bottom: 20px;
            background: #ECECEC;
            border-radius: 7px;
            padding: 15px;
        }
        .dot{
            display: inline-block;
            width: 4px !important;
            height: 4px !important;
            background-color: #00000066;
            border-radius: 50%;
        }
        .notes-label{
            display: flex;
            align-items: center;
            font-family: Genos;
            font-weight: 500;
            font-size: 16px;
            line-height: 100%;
            letter-spacing: 0px;
            color: #1C274C;
            gap: 6px;
        }
        .notes-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 12px;
        }
        .note-item {
            background: #FFFFFF;
            border-radius: 5px;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid #ECECEC;
        }
        .note-content{
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .note-content h5 {
          font-family: Genos;
            font-weight: 400;
            font-size: 16px;
            line-height: 100%;
            letter-spacing: 0px;
            color: #929292;
        }
        .note-content img{
            width: 24px;
            height: 24px;
        }

        /* Form Switch Override */
        .form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
            cursor: pointer;
        }

        .footer-alert {
            background: #ED1C241A;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

         .footer-alert img{
            width: 24px;
            height: 24px;
         }
         .footer-center{
            margin-left: 14px;
            margin-right: 14px;
         }
         .footer-alert h5{
            font-family: Genos;
            font-weight: 400;
            font-size: 16px;
            line-height: 100%;
            color: #929292;
         }
         .footer-alert h5 span{
            font-family: Genos;
            font-weight: 600;
            font-size: 16px;
            line-height: 100%;
            letter-spacing: 0px;
            color: #929292;
         }
        .start-btn-container {
            text-align: center;
            position: relative;
            padding-top: 13px;
        }
        /* Thread line */
        .timeline-line {
            position: absolute;
            top: 25px;
            left: 0;
            right: 50%;
            height: 2px;
            background: #fecaca;
            z-index: 0;
        }
        .start-task-btn {
            margin-bottom: -20px;
            width: 240px;
            position: relative;
            z-index: 1;
            background: #F2F2f2;
            border: 20px;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            padding: 12px;
            color: #1e293b;
            font-size: 12px;
            font-weight: 700;
             border-top-left-radius: 10px;
             border-top-right-radius: 10px;
        }
        .start-btn-icon {
            background: #1BC469;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
        }
         .start-btn-icon img{
            width: 22px;
            height: 22px;
         }
         .start-btn-text{
            font-family: Genos;
            font-weight: 500;
            font-style: Medium;
            font-size: 14px;
            line-height: 100%;
            letter-spacing: 2%;
            color: #1C274C;
         }
        /* In Progress State Override */
        .task-modal-header.in-progress {
            background: linear-gradient(180deg, #84cc16 0%, #22c55e 100%) !important;
        }

        .action-buttons-container {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            padding-top: 30px;
            margin-top: 20px;
            position: relative;
            overflow: visible;
        }
        .action-btn {
            flex: 1;
            background: transparent;
            border: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            font-weight: 700;
            color: #1e293b;
            cursor: pointer;
            padding: 0;
            position: relative;
            transition: transform 0.2s;
        }
        .action-btn:hover {
            transform: translateY(-2px);
        }
        .action-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            position: relative;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .action-icon i {
            position: relative;
            z-index: 1;
        }
        .icon-hold {
            background: #f97316;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
        } /* Orange */
        .icon-check {
            background: #a855f7;
            box-shadow: 0 4px 12px rgba(168, 85, 247, 0.4);
        } /* Purple */

        /* Red timeline lines for action buttons */
        /* .action-buttons-container::before,
        .action-buttons-container::after {
            content: '';
            position: absolute;
            top: 48px;
            height: 2px;
            background: #ef4444;
            z-index: 0;
        } */
        .action-buttons-container::before {
            left: 0;
            width: calc(50% - 34px);
        }
        .action-buttons-container::after {
            right: 0;
            width: calc(50% - 34px);
        }

        /* Badge for In Progress */
        .badge-progress {
            background: #dcfce7;
            color: #22c55e;
        }

        /* Badge for Rejected */
        .badge-rejected {
            background: #fce7f3;
            color: #ec4899;
        }

        /* Badge for Done */
        .badge-done {
            background: #dcfce7;
            color: #22c55e;
        }

        /* Done header styling */
        .task-modal-header.done {
            background: linear-gradient(180deg, #84cc16 0%, #22c55e 100%) !important;
        }

        /* In Progress header styling */
        .task-modal-header.in-progress {
            background: #22c55e;
        }

        /* Rejected header styling */
        .task-modal-header.rejected {
            background: linear-gradient(180deg, #f472b6 0%, #ec4899 100%);
        }

        /* Hold Modal Styles */
        .modal-header.hold-header {
            background: #f97316; /* Orange */
            color: white;
        }

        /* Check Modal Styles */
        .modal-header.check-header {
            background: #a855f7; /* Purple */
            color: white;
        }

        /* Common Alert Box */
        .alert-box-red {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 10px;
            padding: 12px;
            font-size: 11px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-top: 15px;
        }

        /* Toggle Customization */
        .form-check-input:checked {
            background-color: #1DC9A0 !important;
            border-color: #1DC9A0 !important;
        }
        .form-check-input:focus{
            border-color: #C7C7CC !important;
            outline: 0;
            box-shadow: none !important;
        }
        .check-list-item {
            background: white;
            border: 1px solid #f1f5f9;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s;
        }
        .check-list-item:hover {
            border-color: #e2e8f0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .check-list-icon {
            color: #ef4444; /* Red icon color */
            margin-right: 10px;
            font-size: 16px;
        }

        /* Add file box hover effect */
        .add-file-box:hover {
            background: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
        }

        /* On Hold State Override */
        .task-modal-header.on-hold {
            background: linear-gradient(180deg, #facc15 0%, #ca8a04 100%) !important; /* Yellow/Gold */
        }

        .hold-reason-box {
            background: #fefce8; /* Light yellow */
            border: 1px solid #fef08a;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            margin-top: 20px;
            color: #854d0e;
            font-size: 13px;
            font-weight: 600;
            display: none; /* Hidden by default */
        }

        .rejection-reason-box {
            background: #fdf2f8; /* Light pink */
            border: 1px solid #fbcfe8;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            margin-top: 20px;
            color: #9f1239;
            font-size: 13px;
            font-weight: 600;
            display: none; /* Hidden by default */
        }
        .test-ticket{
            background: #F2F2F280;
            border-radius: 7px;
            padding: 6px 12px;
            margin-bottom: 15px;
        }
        .badge-new i{
            font-size: 18px !important;
        }
    </style>

    <div class="content main_content">
        <div style="visibility:visible;">
            @include('Chats.chatsidebar')
        </div>
        @include('Chats.notification')

        <div class="chat chat-messages show" id="middle">
            <div style="display: flex; flex-direction: column; height: 100%; overflow: hidden; flex: 1; min-height: 0;">
                @include('Chats.header')
                <div style="flex: 1; overflow-y: auto; overflow-x: hidden; background-color: #f4f6f8; display: flex; flex-direction: column; -webkit-overflow-scrolling: touch; min-height: 0;">
                    <div class="chat-body chat-page-group p-4" style="max-width: 1400px; margin: 0 auto; width: 100%;">
                        <div class="page-header-custom">
                            <div class="header-title-group">
                                <h1 class="header-title">Tasks</h1>
                                <span class="task-count-badge">{{ $stats['total'] ?? 0 }} Tasks</span>
                                <small class="text-muted ms-2">Tasks amount and overview</small>
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <div class="filter-tabs d-none d-md-flex">
                                    <a href="#" class="filter-tab active">General</a>
                                    <a href="#" class="filter-tab">In Progress</a>
                                    <a href="#" class="filter-tab">In Delayed</a>
                                    <a href="#" class="filter-tab">In Hold</a>
                                </div>

                                <button class="add-project-btn" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                                    <i class="ti ti-plus"></i> Add Project
                                </button>
                            </div>
                        </div>

                        <!-- Stats Cards Row -->
                        <div class="stats-row">
                            <!-- Total Tasks -->
                            <div class="stats-card stat-total">
                                <div class="stats-icon-wrapper">
                                    <img src="{{ $baseUrl }}/build/img/totaltask.svg" alt="Total" style="width: 24px; height: 24px;">
                                </div>
                                <div class="stats-title">Total Tasks</div>
                                <div class="stats-count">{{ $stats['total'] ?? 0 }}</div>
                            </div>

                            <!-- New Task -->
                            <div class="stats-card stat-new">
                                <div class="stats-icon-wrapper">
                                    <img src="{{ $baseUrl }}/build/img/newtask.svg" alt="New" style="width: 24px; height: 24px;">
                                </div>
                                <div class="stats-title">New Task</div>
                                <div class="stats-count">{{ $stats['new'] ?? 0 }}</div>
                            </div>

                            <!-- In Progress -->
                            <div class="stats-card stat-progress">
                                <div class="stats-icon-wrapper">
                                    <img src="{{ $baseUrl }}/build/img/progress.svg" alt="Progress" style="width: 24px; height: 24px;">
                                </div>
                                <div class="stats-title">In Progress</div>
                                <div class="stats-count">{{ $stats['in_progress'] ?? 0 }}</div>
                            </div>

                            <!-- In Hold -->
                            <div class="stats-card stat-hold">
                                <div class="stats-icon-wrapper">
                                    <img src="{{ $baseUrl }}/build/img/inhold.svg" alt="Hold" style="width: 24px; height: 24px;">
                                </div>
                                <div class="stats-title">In Hold</div>
                                <div class="stats-count">{{ $stats['on_hold'] ?? 0 }}</div>
                            </div>

                            <!-- In Checked -->
                            <div class="stats-card stat-checked">
                                <div class="stats-icon-wrapper">
                                    <img src="{{ $baseUrl }}/build/img/incheck.svg" alt="Checked" style="width: 24px; height: 24px;">
                                </div>
                                <div class="stats-title">In Checked</div>
                                <div class="stats-count">{{ $stats['checked'] ?? 0 }}</div>
                            </div>

                            <!-- In Delayed -->
                            <div class="stats-card stat-delayed">
                                <div class="stats-icon-wrapper">
                                    <img src="{{ $baseUrl }}/build/img/delayed.svg" alt="Delayed" style="width: 24px; height: 24px;">
                                </div>
                                <div class="stats-title">In delayed</div>
                                <div class="stats-count">{{ $stats['delayed'] ?? 0 }}</div>
                            </div>

                            <!-- In Rejected -->
                            <div class="stats-card stat-rejected">
                                <div class="stats-icon-wrapper">
                                    <img src="{{ $baseUrl }}/build/img/rejected.svg" alt="Rejected" style="width: 24px; height: 24px;">
                                </div>
                                <div class="stats-title">In Rejected</div>
                                <div class="stats-count">{{ $stats['rejected'] ?? 0 }}</div>
                            </div>

                            <!-- In Done -->
                            <div class="stats-card stat-done">
                                <div class="stats-icon-wrapper">
                                    <img src="{{ $baseUrl }}/build/img/indone.svg" alt="Done" style="width: 24px; height: 24px;">
                                </div>
                                <div class="stats-title">In Done</div>
                                <div class="stats-count">{{ $stats['done'] ?? 0 }}</div>
                            </div>
                        </div>


                        <!-- Central Content: Assigned Tasks -->
                        <div class="section-container">
                            <div class="section-header">
                                <div>
                                    <h2 class="section-title">My Assigned Tasks</h2>
                                    <span class="section-subtitle">Total Tasks: {{ $stats['total'] ?? 0 }}</span>
                                </div>

                                <div class="dropdown">
                                    <button class="project-select-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Select Projects
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item project-option" href="#" data-project-id="all">All Projects</a></li>
                                        @foreach($projects as $p)
                                            <li><a class="dropdown-item project-option" href="#" data-project-id="{{ $p->_id ?? $p->id }}">{{ $p->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <!-- Task List -->
                            <div class="tasks-wrapper" id="tasksListContainer">
                                @php
                                    // Combine and sort all tasks assigned to the user
                                    $mergedTasks = collect($tasks)->merge($webtasks)->merge($employeeTasks)->sortByDesc('created_at');

                                    $normView = fn($s) => strtolower(str_replace([' ', '-'], '_', $s ?? ''));
                                @endphp

                                @forelse($mergedTasks as $index => $task)
                                    @php
                                        $taskStatus = $normView($task->status);

                                        // Map specific status to generic filter classes
                                        $filterClass = 'status-general';
                                        if (in_array($taskStatus, ['new', 'new_task'])) $filterClass .= ' status-new';
                                        if (in_array($taskStatus, ['in_progress', 'progress'])) $filterClass .= ' status-in_progress';
                                        if (in_array($taskStatus, ['on_hold', 'hold', 'in_hold'])) $filterClass .= ' status-on_hold';
                                        if (in_array($taskStatus, ['checked', 'in_checked'])) $filterClass .= ' status-checked';
                                        if (in_array($taskStatus, ['delayed', 'in_delayed'])) $filterClass .= ' status-delayed';
                                        if (in_array($taskStatus, ['rejected', 'in_rejected'])) $filterClass .= ' status-rejected';
                                        if (in_array($taskStatus, ['done', 'completed', 'in_done'])) $filterClass .= ' status-done';
                                    @endphp

                                    @php
                                        // Decode issues if it's a JSON string
                                        $issues = $task->issues ?? [];
                                        if (is_string($issues)) {
                                            $decodedIssues = json_decode($issues, true);
                                            $issues = is_array($decodedIssues) ? $decodedIssues : [];
                                        }
                                        $firstIssue = !empty($issues) && is_array($issues) ? $issues[0] : null;
                                        $issueDescription = $firstIssue['description'] ?? $task->description ?? 'No description available.';
                                        $issueStartDate = isset($firstIssue['start_date']) ? \Carbon\Carbon::parse($firstIssue['start_date'])->format('d.m.Y') : (isset($task->start_date) ? \Carbon\Carbon::parse($task->start_date)->format('d.m.Y') : '12.10.2025');
                                        $issueEndDate = isset($firstIssue['end_date']) ? \Carbon\Carbon::parse($firstIssue['end_date'])->format('d.m.Y') : (isset($task->end_date) ? \Carbon\Carbon::parse($task->end_date)->format('d.m.Y') : '15.10.2025');
                                        $issueImagePath = $firstIssue['mark_image_path'] ?? $task->mark_image_path ?? null;
                                        // Use asset() helper for proper URL generation
                                        if (!empty($issueImagePath)) {
                                            $markImagePath = asset('storage/' . $issueImagePath);
                                        } elseif (!empty($task->mark_image_path)) {
                                            $markImagePath = asset('storage/' . $task->mark_image_path);
                                        } else {
                                            $markImagePath = '';
                                        }

                                        // Extract rejection reason from rejections array
                                        $rejectionReason = '';
                                        $rejections = $task->rejections ?? [];
                                        if (is_string($rejections)) {
                                            $decodedRejections = json_decode($rejections, true);
                                            $rejections = is_array($decodedRejections) ? $decodedRejections : [];
                                        }
                                        if (!empty($rejections) && is_array($rejections)) {
                                            // Get the most recent rejection (last in array)
                                            $latestRejection = end($rejections);
                                            if (isset($latestRejection['reason'])) {
                                                $rejectionReason = $latestRejection['reason'];
                                            }
                                        }
                                    @endphp
                                    <div class="new-task-card {{ $filterClass }}"
                                         data-status="{{ $taskStatus }}"
                                         data-project-id="{{ $task->project_id ?? '' }}"
                                         data-full-task-id="{{ $task->_id ?? $task->id }}"
                                         data-task-id="{{ substr((string)($task->_id ?? $task->id), -4) }}"
                                         data-ticket-id="{{ substr((string)($task->ticket_id ?? '---'), -4) }}"
                                         data-title="{{ $task->title ?? 'Untitled Task' }}"
                                         data-description="{{ $task->description ?? 'No description available.' }}"
                                         data-issue-description="{{ $issueDescription }}"
                                         data-issues="{{ json_encode($issues) }}"
                                         data-start-date="{{ $issueStartDate }}"
                                         data-end-date="{{ $issueEndDate }}"
                                         data-image="{{ $markImagePath }}"
                                         data-index="{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}"
                                         data-project-name="{{ $task->project->title ?? 'Project Name' }}"
                                         data-hold-reason="{{ $task->hold_reason ?? '' }}"
                                         data-rejection-reason="{{ $rejectionReason }}"
                                         data-video-link="{{ $task->video_link ?? '' }}"
                                         data-attachments="{{ json_encode($task->attachments ?? []) }}"
                                         style="cursor: pointer;"
                                         onclick="openTaskModal(this)">

                                        <!-- Left Col: Image + Index -->
                                        <div class="task-image-col">
                                            <div class="red-index-badge">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                                            @if(!empty($task->mark_image_path))
                                                <img src="{{ asset('storage/' . $task->mark_image_path) }}"
                                                     alt="Task"
                                                     style="width: 100%; height: 100%; object-fit: cover; border-radius: 18px; cursor: pointer;"
                                                     onclick="event.stopPropagation(); openIssuesPopup(this, '{{ json_encode($issues) }}', '{{ $task->_id ?? $task->id }}');"
                                                     title="{{ asset('storage/' . $task->mark_image_path) }}"
                                                     onerror="this.style.display='none';">
                                            @else
                                                <!-- Transparent/Placeholder controlled by CSS pattern -->
                                            @endif
                                        </div>

                                        <!-- Right Col: Info -->
                                        <div class="task-info-col">
                                            <!-- Header: Title + Dot -->
                                            <div class="task-header-new">
                                                <div class="task-title-new">{{ $task->title ?? 'Untitled Task' }}</div>
                                                <div class="status-dot-large {{ $filterClass }}" data-status="{{ $taskStatus }}" title="{{ $taskStatus }}"></div>
                                            </div>

                                            <!-- IDs Row -->
                                            <div class="task-ids-row">
                                             <span class="id-pill">
                                                    Task ID: {{ 'TSK-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                                                </span>
                                                <span class="id-pill">Ticket ID: {{ substr((string)($task->ticket_id ?? '---'), -4) }}</span>
                                            </div>

                                            <!-- Description -->
                                            <div class="task-desc-new">
                                                {{ Str::limit($task->description ?? 'Task description will be here', 80) }}
                                            </div>

                                            <!-- Footer: Dates -->
                                            <div class="date-row-pill">
                                                <div class="date-item">
                                                    <i class="ti ti-calendar me-1"></i>
                                                    {{ isset($task->start_date) ? \Carbon\Carbon::parse($task->start_date)->format('d.m.Y') : '12.10.2025' }}
                                                </div>
                                                <div class="date-item">
                                                    <i class="ti ti-arrow-right"></i>
                                                </div>
                                                <div class="date-item">
                                                    {{ isset($task->end_date) ? \Carbon\Carbon::parse($task->end_date)->format('d.m.Y') : '15.10.2025' }}
                                                </div>
                                                <div style="opacity: 0.3;">|</div>
                                                <div class="date-item">
                                                    15:30
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-5 text-muted">
                                        <i class="ti ti-clipboard-off fs-1 mb-3 d-block"></i>
                                        No tasks found. Create a new project or task to get started.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- Task Detail Modal (High Fidelity) -->
    <div class="modal fade" id="taskDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" style="max-width: 500px;"> <!-- Mobile like width -->
            <div class="modal-content task-modal-content">

                <!-- Custom Header -->
                <div class="task-modal-header">
                    <button type="button" class="task-modal-close" data-bs-dismiss="modal">
                        <i class="ti ti-x"></i>
                    </button>
                    <div class="task-project-name" id="modalProjectName">Project Name</div>
                    <div class="task-ticket-name">Ticket #<span id="modalTicketNum">1</span> - Ticket Title</div>

                    <!-- Logo Circle -->
                    <div class="logo-circle">
                        <!-- Standard Logo or B icon -->
                        <img src="{{ $baseUrl }}/build/img/AI-Logo.svg" alt="Logo" style="width: 32px;">
                    </div>
                </div>

                <!-- Body -->
                <div class="task-modal-body">
                    <div class="test-ticket">
                        <h3 class="modal-task-title" id="modalTaskTitleDisplay">Task Title</h3>

                    <!-- Badges -->
                    <div class="modal-tags" id="modalBadgesContainer">
                        <div class="badge-custom badge-new" id="badgeStatus">
                            <i class="ti ti-flag"></i> New Task
                        </div>
                        <div class="badge-id">
                            <div class="badge-icon">
                                 <i class="ti ti-bolt"></i>
                            </div>
                            <div class="badge-text">
                                <span id="modalIndexDisplay"> - 01 -</span>
                            </div>

                        </div>
                        <div class="badge-custom badge-low">
                            <i class="ti ti-circle"></i> Low
                        </div>
                    </div>

                    <!-- Meta Row -->
                    <div class="meta-row">
                        <div class="meta-item">Task ID:  <span id="modalTaskIdDisplay">E5B4</span></div>
                        <div class="meta-divider"></div>
                        <div class="meta-item">Section: <span id="modalSectionDisplay">Dev</span></div>
                        <div class="meta-divider"></div>
                        <div class="meta-item"><span class="meta-label">Start:</span> <span id="modalStartDateDisplay">22.10</span></div>
                        <div class="meta-divider"></div>
                        <div class="meta-item"><span class="meta-label">Deliver:</span> <span id="modalEndDateDisplay">23.10</span></div>
                    </div>
                    </div>

                    <!-- Issue Description -->
                    <div class="desc-box">
                        <h5 class="desc-label">
                            <span class="dot"></span>
                            <span>Issue Description</span>
                            <span class="dot"></span>
                        </h5>
                        <p id="modalTaskDescriptionDisplay">
                            Move the close button more down due is to near on the popup.
                        </p>
                    </div>

                    <!-- Image Area -->
                    <div class="image-preview-area" id="modalImageArea">
                        <img id="modalTaskImageFull" src="" style="display:none;" alt="Proof" title="">
                        <div id="issueBadgesContainer"></div>
                        <div id="modalImagePlaceholder" style="text-align:center;">
                            <i class="ti ti-photo-off fs-1"></i>
                            <br>No Image
                        </div>
                    </div>

                    <!-- Notes / Toggles (Default State) -->
                    <div class="notes-section" id="defaultNotesSection">
                        <h5 class="notes-label">
                            <span class="dot"></span>
                            <span>Notes</span>
                            <span  class="dot"></span>

                        </h5>
                        <div class="notes-list">
                            <!-- Static Checklist for demo/default, could be dynamic later -->
                            <div class="note-item">
                                <div class="note-content">
                                 <img src="/build/img/current.svg" alt="icon">
                                <h5>Take Backup before start Development</h5>
                                </div>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input required-checkbox" type="checkbox" checked>
                                </div>
                            </div>
                            <div class="note-item">
                                <div class="note-content">
                                    <img src="/build/img/current.svg" alt="icon">
                                   <h5>Work on your Local Server</h5>
                                </div>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input required-checkbox" type="checkbox">
                                </div>
                            </div>
                            <div class="note-item">
                                <div class="note-content">
                                    <img src="/build/img/current.svg" alt="icon">
                                    <h5>Check your work before u deliver the work</h5>
                                </div>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input required-checkbox" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Notes Section (In Checking Status) -->
                    <div class="notes-section" id="adminNotesSection" style="display: none;">
                        <span class="desc-label">Admin Notes</span>
                        <div class="note-item">
                            <div class="note-content">
                                <i class="ti ti-bolt note-icon"></i> Please check the Task Attachment before take action
                            </div>
                        </div>
                    </div>

                    <!-- Video Attachments Section (In Checking Status) -->
                    <div class="notes-section" id="videoAttachmentsSection" style="display: none;">
                        <span class="desc-label">Video Attachments</span>
                        <div style="background: #fff; border: 1px solid #f1f5f9; border-radius: 12px; padding: 15px; position: relative;">
                            <i class="ti ti-video" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #64748b; font-size: 18px;"></i>
                            <div id="modalVideoLinkDisplay" style="color: #64748b; font-size: 13px; padding-left: 40px; min-height: 24px; display: flex; align-items: center;">
                                Video Link will be here to check the work
                            </div>
                        </div>
                    </div>

                    <!-- File Attachments Section (In Checking Status) -->
                    <div class="notes-section" id="fileAttachmentsSection" style="display: none;">
                        <span class="desc-label">File Attachments</span>
                        <div id="modalFileAttachmentsList" style="display: flex; flex-direction: column; gap: 10px;">
                            <!-- Files will be populated dynamically -->
                        </div>
                    </div>

                    <!-- Footer Alert (Default) -->
                     <div class="footer-center">
                         <div class="footer-alert" id="defaultFooterAlert">
                        <img src="/build/img/current.svg" alt="icon">
                        <h5>You can Start this Project on <span id="modalStartFull">23.12.2025</span></h5>
                    </div>
                     </div>


                    <!-- Footer Alert (In Checking Status) -->
                    <div class="footer-alert" id="checkingFooterAlert" style="display: none;">
                        <i class="ti ti-bolt"></i>
                        Task Under view through the Project Manager Duration Time: <span id="modalCheckingDuration">24.10.2025 - 12:30</span>
                    </div>

                    <!-- Start Button (Initial State) -->
                    <div class="start-btn-container" id="startBtnContainer">
                        <button class="start-task-btn" onclick="openStartConfirmationModal()">
                            <div class="start-btn-icon">
                                 <img src="/build/img/Rocket.svg" alt="icon">
                            </div>
                            <p class="start-btn-text">Start the Tasks</p>
                        </button>


                    <!-- Action Buttons (In Progress State) -->
                    <div class="action-buttons-container" id="actionButtonsContainer" style="display: none;">
                        <button class="action-btn" onclick="openHoldModal()">
                            <div class="action-icon icon-hold">
                                <i class="ti ti-folder-pause"></i>
                            </div>
                            <span>Move to in Hold</span>
                        </button>
                        <button class="action-btn" onclick="openCheckModal()">
                            <div class="action-icon icon-check">
                                <i class="ti ti-folder-check"></i>
                            </div>
                            <span>Move to in Check</span>
                        </button>
                    </div>

                    <!-- Hold Reason Display (On Hold State) -->
                    <div class="hold-reason-box" id="holdReasonContainer">
                        <div style="margin-bottom: 5px;">
                            <i class="ti ti-hand-stop" style="font-size: 24px; color: #f59e0b;"></i>
                        </div>
                        <div id="holdReasonText">The Hold Reason will be here</div>
                    </div>

                    <!-- Rejection Reason Display (Rejected State) -->
                    <div class="rejection-reason-box" id="rejectionReasonContainer">
                        <div style="margin-bottom: 5px;">
                            <i class="ti ti-x-circle" style="font-size: 24px; color: #ec4899;"></i>
                        </div>
                        <div id="rejectionReasonText">The Rejection Reason will be here</div>
                    </div>

                    <!-- Start Task Button (Rejected State) -->
                    <div class="start-btn-container" id="rejectedStartBtnContainer" style="display: none;">
                        <div class="timeline-line"></div>
                        <button class="start-task-btn" onclick="openStartConfirmationModal()">
                            <div class="start-btn-icon">
                                <i class="ti ti-rocket"></i>
                            </div>
                            Start the Task
                        </button>
                    </div>

                    <!-- Go To Task Button (On Hold State) -->
                    <div class="start-btn-container" id="goToTaskBtnContainer" style="display: none;">
                        <div class="timeline-line"></div>
                        <button class="start-task-btn" onclick="openStartConfirmationModal()">
                            <div class="start-btn-icon">
                                <i class="ti ti-rocket"></i>
                            </div>
                            Go to the task
                        </button>
                    </div>

                    <!-- Continue Task Button (Checked State) -->
                    <div id="continueTaskBtnContainer" style="display: none; text-align: center; margin-top: 20px;">
                        <div class="timeline-line"></div>
                        <button type="button" onclick="continueTask()" style="background: white; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-radius: 12px; padding: 15px 30px; display: inline-flex; flex-direction: column; align-items: center; gap: 8px; width: 100%;">
                            <div style="background: #22c55e; width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="ti ti-rocket" style="font-size: 24px; color: white;"></i>
                            </div>
                            <span style="font-weight: 700; font-size: 14px; color: #334155;">continue the task</span>
                        </button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Confirmation Modal -->
    <div class="modal fade" id="startConfirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content task-modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" style="font-family: 'Outfit', sans-serif;">Start the Task</h5>
                    <!-- Close button is hidden in design or handled below -->
                </div>
                <div class="modal-body pt-2 text-center" style="font-family: 'Outfit', sans-serif;">

                    <!-- Rocket Icon -->
                    <div style="width: 80px; height: 80px; background: #22c55e; border-radius: 12px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="ti ti-rocket" style="font-size: 40px; color: white;"></i>
                    </div>

                    <!-- Date Box -->
                    <div class="p-3 mb-3" style="background: #f8fafc; border-radius: 12px;">
                        <div class="mb-2" style="color: #64748b; font-weight: 600; font-size: 13px;">Task Start Date and Time</div>

                        <div class="d-flex align-items-center justify-content-between px-3 py-2 bg-white border border-light rounded-3 shadow-sm">
                            <div class="d-flex align-items-center gap-2">
                                <div style="background: #bef264; padding: 4px; border-radius: 6px;">
                                    <i class="ti ti-clock" style="color: #475569;"></i>
                                </div>
                                <span style="font-size: 13px; font-weight: 700; color: #22c55e;">Started: <span class="text-dark" id="confirmStartDate">23.10.2024</span></span>
                            </div>
                            <div style="border-left: 1px solid #e2e8f0; height: 20px;"></div>
                            <span style="font-size: 13px; font-weight: 700; color: #22c55e;">Time: <span class="text-dark">12:45</span></span>
                        </div>

                        <div class="mt-3" style="font-size: 13px; color: #64748b; font-weight: 500;">
                            Task will move to the Section "<span style="color: #84cc16; font-weight: 700;">In Progress</span>"
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="d-flex gap-3 justify-content-center mt-4">
                        <button type="button" class="btn btn-light text-muted fw-bold px-4" data-bs-dismiss="modal" style="background:#f1f5f9; border:none;">Close</button>
                        <button type="button" onclick="confirmStartTask()" class="btn btn-light text-muted fw-bold px-4" style="background:#f1f5f9; border:none;">Move on</button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- --------------------------
         HOLD CONFIRMATION MODAL
         -------------------------- -->
    <div class="modal fade" id="holdConfirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content task-modal-content">
                <!-- Orange Header -->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" style="font-family: 'Outfit', sans-serif;">Task to In Hold</h5>
                </div>
                <div class="modal-body pt-2 text-center" style="font-family: 'Outfit', sans-serif;">

                    <!-- Orange Custom Icon -->
                    <div style="margin: 0 auto 15px; width: 60px; height: 60px; background: #f97316; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="ti ti-hand-stop" style="font-size: 30px; color: white;"></i>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-start w-100 text-muted" style="font-size: 12px;">Select the reason for why to move the Task to <strong style="color:#f97316">'In Hold'</strong></label>
                        <select id="holdReasonSelect" class="form-select border-0 bg-light" style="font-size: 13px;">
                            <option value="">Select the reason</option>
                            <option value="Pending Dependencies">Pending Dependencies</option>
                            <option value="Client Feedback">Client Feedback</option>
                            <option value="Internal Review">Internal Review</option>
                        </select>
                    </div>

                    <div class="text-muted mb-3" style="font-size: 12px;">Task will move to the Section <strong style="color:#f97316">"In Hold"</strong></div>

                    <!-- Date Time Display -->
                    <div class="d-flex align-items-center justify-content-center gap-3 py-2 mb-3" style="background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 12px;">
                        <div class="d-flex align-items-center gap-1 text-success fw-bold">
                            <i class="ti ti-clock-pause"></i> Moved: <span id="holdDateDisplay">23.10.2024</span>
                        </div>
                        <div class="text-success fw-bold">Time: <span id="holdTimeDisplay">12:45</span></div>
                    </div>

                    <!-- Red Alert -->
                    <div class="alert-box-red text-start">
                        <i class="ti ti-bolt" style="font-size: 18px;"></i>
                        <div>
                            The task will be listed "In Hold" Section.<br>
                            Duration 12 Hours, Task will be moved to "In Delayed"
                        </div>
                        <div class="form-check form-switch ms-auto">
                            <input class="form-check-input" type="checkbox" checked>
                        </div>
                    </div>

                    <div class="d-flex gap-3 justify-content-center mt-4">
                        <button type="button" class="btn btn-light text-muted fw-bold px-4" data-bs-dismiss="modal" style="background:#f1f5f9; border:none;">Close</button>
                        <button type="button" onclick="confirmMoveToHold()" class="btn btn-light text-muted fw-bold px-4" style="background:#f1f5f9; border:none;">Move on</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- --------------------------
         CHECK CONFIRMATION MODAL
         -------------------------- -->
    <div class="modal fade" id="checkConfirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content task-modal-content">
                <!-- Header -->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" style="font-family: 'Outfit', sans-serif;">Task to Checked</h5>
                </div>

                <div class="modal-body pt-2" style="font-family: 'Outfit', sans-serif;">

                    <!-- Purple Folder Icon with Exclamation -->
                    <div class="text-center mb-3">
                        <div style="margin: 0 auto; width: 80px; height: 80px; background: #a855f7; border-radius: 16px; display: flex; align-items: center; justify-content: center; position: relative;">
                            <i class="ti ti-folder" style="font-size: 40px; color: white;"></i>
                            <div style="position: absolute; top: -5px; right: -5px; width: 24px; height: 24px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid #a855f7;">
                                <i class="ti ti-alert-circle" style="font-size: 14px; color: #a855f7;"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Date Time Display Bar -->
                    <div class="d-flex align-items-center justify-content-center gap-2 py-2 mb-4" style="background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0; font-size: 12px; padding: 10px 15px;">
                        <div style="width: 24px; height: 24px; background: #a855f7; border-radius: 6px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="ti ti-folder" style="font-size: 12px; color: white;"></i>
                            <div style="position: absolute; width: 8px; height: 8px; background: white; border-radius: 50%; margin-top: -8px; margin-left: 8px;"></div>
                        </div>
                        <div class="d-flex align-items-center gap-1" style="color: #22c55e; font-weight: 700;">
                            <span>Moved: <span id="checkDateDisplay" style="color: #1e293b;">23.10.2024</span></span>
                        </div>
                        <div style="width: 1px; height: 20px; background: #e2e8f0;"></div>
                        <div style="color: #22c55e; font-weight: 700;">
                            <span>Time: <span id="checkTimeDisplay" style="color: #1e293b;">12:45</span></span>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="text-start mb-4">
                        <label class="fw-bold mb-3 d-flex align-items-center" style="font-size: 12px; color: #64748b;">
                            <span style="width: 6px; height: 6px; background: #64748b; border-radius: 50%; margin-right: 8px;"></span>
                            Notes
                        </label>

                        <div class="check-list-item">
                            <div class="d-flex align-items-center">
                                <i class="ti ti-bolt check-list-icon"></i>
                                <span style="font-size: 12px; color: #334155;">Did u solve the issue ?</span>
                            </div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>

                        <div class="check-list-item">
                            <div class="d-flex align-items-center">
                                <i class="ti ti-bolt check-list-icon"></i>
                                <span style="font-size: 12px; color: #334155;">Did u Chekcked your work</span>
                            </div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </div>
                        <div class="check-list-item">
                            <div class="d-flex align-items-center">
                                <i class="ti ti-bolt check-list-icon"></i>
                                <span style="font-size: 12px; color: #334155;">Show us Video and Images about the work</span>
                            </div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </div>
                    </div>

                    <!-- Share work Attachments -->
                    <div class="text-start mb-4">
                        <label class="fw-bold mb-3 d-flex align-items-center" style="font-size: 12px; color: #64748b;">
                            <span style="width: 6px; height: 6px; background: #64748b; border-radius: 50%; margin-right: 8px;"></span>
                            Share work Attachments
                        </label>
                        <div class="position-relative">
                            <i class="ti ti-video" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #64748b; font-size: 18px; z-index: 1;"></i>
                            <input type="text" id="checkVideoLink" class="form-control" placeholder="Video Link will be here to check the work" style="font-size: 12px; background: #f8fafc; border: 1px solid #e2e8f0; padding: 10px 10px 10px 40px; border-radius: 8px;">
                        </div>
                    </div>

                    <!-- File Attachments -->
                    <div class="text-start mb-4">
                        <label class="fw-bold mb-3 d-flex align-items-center" style="font-size: 12px; color: #64748b;">
                            <span style="width: 6px; height: 6px; background: #64748b; border-radius: 50%; margin-right: 8px;"></span>
                            File Attachments
                        </label>
                        <div class="d-flex gap-2 flex-wrap">
                            <!-- Existing File -->
                            <div id="existingFileBox" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 12px; display: flex; align-items: center; gap: 8px; min-width: 140px;">
                                <i class="ti ti-file-type-pdf" style="font-size: 20px; color: #ef4444;"></i>
                                <div style="font-size: 10px; flex: 1;">
                                    <div style="font-weight: 600; color: #1e293b;">File Title.pdf</div>
                                    <div style="color: #64748b;">94 KB of 94 KB</div>
                                </div>
                                <i class="ti ti-trash" style="font-size: 16px; color: #ef4444; cursor: pointer;" onclick="removeFile(this)"></i>
                            </div>

                            <!-- Add File Box 1 -->
                            <div class="add-file-box" style="background: #f8fafc; border: 1px dashed #e2e8f0; border-radius: 8px; padding: 20px; display: flex; flex-direction: column; align-items: center; justify-content: center; min-width: 140px; cursor: pointer; transition: all 0.2s;" onclick="triggerFileUpload(this)">
                                <i class="ti ti-plus" style="font-size: 24px; color: #94a3b8; margin-bottom: 8px;"></i>
                                <div style="font-size: 9px; color: #94a3b8; text-align: center; line-height: 1.3;">MP4 - JPG<br>PDF - PNG</div>
                                <input type="file" class="file-upload-input" style="display: none;" accept=".mp4,.jpg,.jpeg,.pdf,.png" onchange="handleFileUpload(this, event)">
                            </div>

                            <!-- Add File Box 2 -->
                            <div class="add-file-box" style="background: #f8fafc; border: 1px dashed #e2e8f0; border-radius: 8px; padding: 20px; display: flex; flex-direction: column; align-items: center; justify-content: center; min-width: 140px; cursor: pointer; transition: all 0.2s;" onclick="triggerFileUpload(this)">
                                <i class="ti ti-plus" style="font-size: 24px; color: #94a3b8; margin-bottom: 8px;"></i>
                                <div style="font-size: 9px; color: #94a3b8; text-align: center; line-height: 1.3;">MP4 - JPG<br>PDF - PNG</div>
                                <input type="file" class="file-upload-input" style="display: none;" accept=".mp4,.jpg,.jpeg,.pdf,.png" onchange="handleFileUpload(this, event)">
                            </div>
                        </div>
                    </div>

                    <!-- Pink/Red Alert Box -->
                    <div class="alert-box-red text-start d-flex align-items-start gap-3 mb-4" style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; padding: 12px;">
                        <i class="ti ti-bolt" style="font-size: 18px; color: #ef4444; flex-shrink: 0; margin-top: 2px;"></i>
                        <div style="flex: 1; font-size: 11px; color: #991b1b; line-height: 1.4;">
                            The project manager will review the attachments and<br>
                            get back to you within max. 12 hours.
                        </div>
                        <div class="form-check form-switch m-0" style="flex-shrink: 0;">
                            <input class="form-check-input" type="checkbox" checked>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-3 justify-content-center mt-4">
                        <button type="button" class="btn fw-bold px-4" data-bs-dismiss="modal" style="background: #fff; color: #64748b; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 20px;">Close</button>
                        <button type="button" onclick="confirmMoveToCheck()" class="btn fw-bold px-4" style="background: #fff; color: #1e293b; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 20px;">Move on</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Issues Selection Popup -->
    <div class="modal fade" id="issuesSelectionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content task-modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" style="font-family: 'Outfit', sans-serif;">Select Issue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2" style="font-family: 'Outfit', sans-serif;">
                    <div id="issuesListContainer" style="display: flex; flex-direction: column; gap: 10px;">
                        <!-- Issue numbers will be populated here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Issue Detail Popup -->
    {{--<div class="modal fade" id="issueDetailModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">--}}
    {{--    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">--}}
    {{--        <div class="modal-content task-modal-content" style="box-shadow: 0 10px 40px rgba(0,0,0,0.2);">--}}
    {{--            <div class="modal-header border-0 pb-0">--}}
    {{--                <h5 class="modal-title fw-bold text-dark" style="font-family: 'Outfit', sans-serif;">Issue Details</h5>--}}
    {{--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
    {{--            </div>--}}
    {{--            <div class="modal-body pt-2" style="font-family: 'Outfit', sans-serif;">--}}
    {{--                <div class="desc-box mb-3">--}}
    {{--                    <span class="desc-label">Issue Title</span>--}}
    {{--                    <p id="issueDetailTitle" style="margin:0; line-height:1.4; font-weight: 600; color: #1e293b;"></p>--}}
    {{--                </div>--}}
    {{--                <div class="desc-box mb-3">--}}
    {{--                    <span class="desc-label">Issue Description</span>--}}
    {{--                    <p id="issueDetailDescription" style="margin:0; line-height:1.4;"></p>--}}
    {{--                </div>--}}
    {{--                <div class="meta-row mb-3">--}}
    {{--                    <div class="meta-item">Start Date <span id="issueDetailStartDate">-</span></div>--}}
    {{--                    <div class="meta-item">|</div>--}}
    {{--                    <div class="meta-item">End Date <span id="issueDetailEndDate">-</span></div>--}}
    {{--                </div>--}}
    {{--                <div class="desc-box">--}}
    {{--                    <span class="desc-label">Task ID</span>--}}
    {{--                    <p id="issueDetailTaskId" style="margin:0; line-height:1.4; font-weight: 600; color: #1e293b;"></p>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}
   <div class="modal fade" id="issueDetailModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" style="max-width:500px;">

        <div class="modal-content"
             style="border-radius:14px;
            border:1px solid #e5e7eb;
            box-shadow:0 15px 40px rgba(0,0,0,.18);
            padding:14px;
            font-family:'Segoe UI',sans-serif;">

            <!-- ================= HEADER ================= -->
            <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            border-bottom:1px solid #eee;
            padding-bottom:8px;
            margin-bottom:10px;">

                <!-- LEFT SIDE (dot + title) -->
                <div style="display:flex; align-items:center; gap:8px;">
                <span id="issueAccentDot"
                      style="width:10px;
                             height:10px;
                             border-radius:50%;
                             background:#ef4444;
                             flex-shrink:0;">
                </span>

                    <span id="issueDetailTitle"
                          style="font-weight:700;
                             font-size:15px;
                             color:#111827;">
                </span>
                </div>

                <!-- RIGHT SIDE (close icon) -->
                <button type="button"
                        data-bs-dismiss="modal"
                        style="background:none;
                           border:none;
                           font-size:22px;
                           font-weight:700;
                           color:#6b7280;
                           cursor:pointer;
                           line-height:1;">
                    ×
                </button>
            </div>

            <!-- ================= BODY ================= -->
            <div>

                <!-- Image container -->
                <div id="issueImageBox"
                     style="display:none;
                        text-align:center;
                        margin-bottom:12px;
                        width:100%;
                        overflow:hidden;">
                    <!-- imageHtml will be inserted here by JavaScript -->
                </div>
                <!-- Description -->
                <div id="issueDetailDescription"
                     style="background:#f8fafc;
                        border:1px solid #eef2f7;
                        border-radius:10px;
                        padding:10px;
                        font-size:13px;
                        color:#334155;
                        line-height:1.5;
                        margin-bottom:12px;">
                </div>

                <!-- Dates -->
                <div style="display:flex;
                        gap:8px;
                        flex-wrap:wrap;
                        margin-bottom:16px;">

                <span style="background:#ecfdf3;
                             color:#16a34a;
                             border:1px solid #bbf7d0;
                             padding:4px 10px;
                             border-radius:8px;
                             font-weight:600;
                             font-size:12px;">
                    Start: <span id="issueDetailStartDate">-</span>
                </span>

                    <span style="background:#ecfdf3;
                             color:#16a34a;
                             border:1px solid #bbf7d0;
                             padding:4px 10px;
                             border-radius:8px;
                             font-weight:600;
                             font-size:12px;">
                    End: <span id="issueDetailEndDate">-</span>
                </span>
                </div>

                <!-- Close button -->
                <div style="text-align:center;">
                    <button data-bs-dismiss="modal"
                            style="background:#28c76f;
                               color:white;
                               border:none;
                               padding:8px 28px;
                               border-radius:8px;
                               font-weight:600;
                               cursor:pointer;">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="extraActionModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:500px;">
            <div class="modal-content" style="
                border-radius:20px;
                padding:0;
                border:none;
                background:#ffffff;
                box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            ">

                <!-- Header -->
                <h3 style="
                    font-weight:600;
                    margin:0;
                    padding:18px 28px;
                    color:#3a4a6b;
                    background:#ededef;
                    font-family:'Outfit',sans-serif;
                    font-size:21px;
                    border-radius:20px 20px 0 0;
                ">
                    Start the Task
                </h3>

                <div style="padding:28px 28px 26px;">

                    <!-- Icon -->
                    <div style="text-align:center; margin-bottom:20px;">
                        <div style="
                        width:105px;
                        height:105px;
                        background:#52c655;
                        border-radius:14px;
                        margin:0 auto;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                    ">
                            <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4.5 16.5c-1.5 1.25-2 5-2 5s3.75-.5 5-2c.71-.71.71-1.79 0-2.5-.71-.71-1.79-.71-2.5 0z"></path>
                                <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
                                <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path>
                                <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Content Box -->
                    <div style="
                    background:#f2f2f4;
                    border-radius:12px;
                    padding:20px 18px;
                    margin-bottom:24px;
                ">

                        <!-- Title -->
                        <h6 style="
                        text-align:center;
                        font-weight:600;
                        margin-bottom:16px;
                        color:#3a4a6b;
                        font-size:17px;
                        font-family:'Outfit',sans-serif;
                    ">
                            Task Start Date and Time
                        </h6>

                        <!-- Date Time Container -->
                        <div style="
                        background:#e2e2e4;
                        border-radius:11px;
                        padding:11px 13px;
                        display:flex;
                        align-items:center;
                        gap:11px;
                    ">
                            <!-- Icon with layers -->
                            <div style="position:relative; width:36px; height:36px; flex-shrink:0;">
                                <!-- Green tilted background -->
                                <span style="
                                position:absolute;
                                top:2px;
                                left:1px;
                                width:26px;
                                height:26px;
                                border-radius:6px;
                                background:#a3d142;
                                transform:rotate(7deg);
                            "></span>
                                <!-- Clock icon on white background -->
                                <span style="
                                position:absolute;
                                right:0;
                                bottom:0;
                                width:27px;
                                height:27px;
                                border-radius:6px;
                                background:#ffffff;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                            ">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#7a8599" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 7 12 12 15 15"></polyline>
                                </svg>
                            </span>
                            </div>

                            <!-- Date and Time Info -->
                            <div style="
                            background:#ffffff;
                            border-radius:9px;
                            padding:8px 15px;
                            display:flex;
                            align-items:center;
                            gap:12px;
                            flex:1;
                        ">
                                <!-- Started Date -->
                                <div style="font-family:'Outfit',sans-serif; font-size:15px; white-space:nowrap;">
                                    <span style="color:#52c655; font-weight:600;">Started:</span>
                                    <span style="font-weight:600; color:#3a4a6b;"> 23.10.2024</span>
                                </div>

                                <!-- Divider -->
                                <div style="width:1px; height:22px; background:#d0d2d8;"></div>

                                <!-- Time -->
                                <div style="font-family:'Outfit',sans-serif; font-size:15px; white-space:nowrap;">
                                    <span style="color:#52c655; font-weight:600;">Time:</span>
                                    <span style="font-weight:600; color:#3a4a6b;"> 12:45</span>
                                </div>
                            </div>
                        </div>

                        <!-- Status Message -->
                        <div style="
                        text-align:center;
                        margin-top:16px;
                        font-size:15px;
                        color:#3a4a6b;
                        font-family:'Outfit',sans-serif;
                    ">
                            Task will move to the Section
                            <span style="color:#8bb63f; font-weight:600;">"In Progress"</span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div style="
                    display:flex;
                    gap:16px;
                ">
                        <button
                            class="btn"
                            data-bs-dismiss="modal"
                            style="
                            flex:1;
                            padding:12px;
                            border-radius:9px;
                            background:#e5e5e7;
                            color:#7a8599;
                            font-weight:600;
                            border:none;
                            font-family:'Outfit',sans-serif;
                            font-size:15px;
                        "
                        >
                            Close
                        </button>

                        <button
                            class="btn"
                            style="
                            flex:1;
                            padding:12px;
                            border-radius:9px;
                            background:#e5e5e7;
                            color:#7a8599;
                            font-weight:600;
                            border:none;
                            font-family:'Outfit',sans-serif;
                            font-size:15px;
                        "
                        >
                            Move on
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>

        {{--<!-- Add Task Modals (Keeping simplified placeholders or including existing ones if verified) -->--}}
    @include('Chats.partials.modals')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tasksContainer = document.getElementById('tasksListContainer');
            const tasks = document.querySelectorAll('.new-task-card');
            const filterTabs = document.querySelectorAll('.filter-tab');
            const statsCards = document.querySelectorAll('.stats-card');
            const countSubtitle = document.querySelector('.section-subtitle');
            const dropdownItems = document.querySelectorAll('.project-option'); // We need to add this class to dropdown items

            let currentFilter = 'all'; // all, new, in_progress, etc.
            let currentProject = 'all';

            function filterTasks() {
                let visibleCount = 0;

                tasks.forEach(task => {
                    const statusClasses = task.className; // contains status-new, status-in_progress etc.
                    const projectId = task.getAttribute('data-project-id');

                    let matchesStatus = (currentFilter === 'all') || statusClasses.includes('status-' + currentFilter);
                    let matchesProject = (currentProject === 'all') || (projectId === currentProject);

                    if (matchesStatus && matchesProject) {
                        task.style.display = 'flex';
                        visibleCount++;
                    } else {
                        task.style.display = 'none';
                    }
                });

                // Update subtitle count
                if(countSubtitle) {
                    const filterName = currentFilter === 'all' ? 'Total' : currentFilter.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
                    countSubtitle.textContent = filterName + ' Tickets: ' + visibleCount;
                }
            }


            // 1. Tab Filters
            filterTabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Remove active class
                    filterTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const text = this.textContent.trim().toLowerCase();
                    // Map text to filter key
                    if(text === 'general') currentFilter = 'all';
                    else if(text === 'in progress') currentFilter = 'in_progress';
                    else if(text === 'in delayed') currentFilter = 'delayed';
                    else if(text === 'in hold') currentFilter = 'on_hold';

                    filterTasks();
                });
            });

            // 2. Stats Card Filters
            statsCards.forEach(card => {
                card.style.cursor = 'pointer'; // Make clickable
                card.addEventListener('click', function() {
                    // Determine filter from unique class or title
                    if(this.classList.contains('stat-total')) currentFilter = 'all';
                    else if(this.classList.contains('stat-new')) currentFilter = 'new';
                    else if(this.classList.contains('stat-progress')) currentFilter = 'in_progress';
                    else if(this.classList.contains('stat-hold')) currentFilter = 'on_hold';
                    else if(this.classList.contains('stat-checked')) currentFilter = 'checked';
                    else if(this.classList.contains('stat-delayed')) currentFilter = 'delayed';
                    else if(this.classList.contains('stat-rejected')) currentFilter = 'rejected';
                    else if(this.classList.contains('stat-done')) currentFilter = 'done';

                    // Update tabs URL state (optional, just visual sync)
                    filterTabs.forEach(t => t.classList.remove('active'));
                    // Try to find matching tab
                    // ... (simplified sync)

                    filterTasks();

                    // Visual feedback on card
                    statsCards.forEach(c => c.style.transform = 'none');
                    this.style.transform = 'translateY(-5px)';
                });
            });

            // 3. Project Dropdown
            dropdownItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const projectId = this.getAttribute('data-project-id');
                    currentProject = projectId;

                    // Update dropdown button text (optional UX improvement)
                    const dropdownBtn = document.querySelector('.project-select-btn');
                    if(dropdownBtn) dropdownBtn.textContent = this.textContent;

                    filterTasks();
                });
            });
        });

        // Function to Open Task Modal
        function openTaskModal(element) {
            // Retrieve data
            const title = element.getAttribute('data-title');
            const desc = element.getAttribute('data-description');
            const issueDesc = element.getAttribute('data-issue-description');
            const issuesJson = element.getAttribute('data-issues');
            const taskId = element.getAttribute('data-task-id');
            const fullTaskId = element.getAttribute('data-full-task-id');
            const ticketId = element.getAttribute('data-ticket-id');
            const startDate = element.getAttribute('data-start-date');
            const endDate = element.getAttribute('data-end-date');
            const imageSrc = element.getAttribute('data-image');
            const index = element.getAttribute('data-index');
            const projectName = element.getAttribute('data-project-name');

            // Status Handling
            const status = element.getAttribute('data-status');
            const isInProgress = ['in_progress', 'progress'].includes(status);
            const isOnHold = ['on_hold', 'hold'].includes(status);
            const isChecked = ['checked', 'check', 'checking', 'in_checking'].includes(status);
            const isRejected = ['rejected', 'in_rejected'].includes(status);
            const isDone = ['done', 'completed', 'in_done'].includes(status);
            const isNewTask = ['new', 'new_task'].includes(status);

            // Populate Fields
            document.getElementById('modalTaskTitleDisplay').textContent = title;

            // Use issue description if available, otherwise fall back to task description
            const descriptionToShow = issueDesc && issueDesc !== 'No description available.' ? issueDesc : (desc || "No description provided.");
            document.getElementById('modalTaskDescriptionDisplay').textContent = descriptionToShow;

            const formattedTaskId = 'TSK-' + String(parseInt(index)).padStart(3, '0');
            document.getElementById('modalTaskIdDisplay').textContent = formattedTaskId;

            function formatDate(dateString) {
                if (!dateString) return 'N/A';

                const parts = dateString.split('.');
                const day = parts[0];
                const month = parts[1];
                const year = parts[2];

                return `${day}.${month}.${year}`;
            }
            // document.getElementById('modalTicketId').textContent = ticketId;
            document.getElementById('modalStartDateDisplay').textContent = formatDate(startDate);
            document.getElementById('modalEndDateDisplay').textContent = formatDate(endDate);
            document.getElementById('modalIndexDisplay').textContent = "-" + index + "-";

            document.getElementById('modalProjectName').textContent = projectName;
            document.getElementById('modalTicketNum').textContent = ticketId;

            document.getElementById('modalStartFull').textContent = startDate || 'N/A';

            // Store full task ID globally
            window.currentTaskIdForStart = fullTaskId;

            // Store issues and task ID for issue popup
            if (issuesJson && issuesJson !== '[]' && issuesJson !== 'null') {
                try {
                    const parsed = JSON.parse(issuesJson);
                    window.currentTaskIssues = Array.isArray(parsed) ? parsed : [];
                    console.log('Parsed issues:', window.currentTaskIssues);
                } catch (e) {
                    console.error('Error parsing issues JSON:', e, 'Raw:', issuesJson);
                    window.currentTaskIssues = [];
                }
            } else {
                window.currentTaskIssues = [];
                console.log('No issues JSON provided or empty');
            }
            window.currentFullTaskId = fullTaskId;

            // Clear issue badges container
            const badgesContainer = document.getElementById('issueBadgesContainer');
            if (badgesContainer) {
                badgesContainer.innerHTML = '';
            }

            // --- Toggle UI State ---
            const header = document.querySelector('.task-modal-header');
            const startBtn = document.getElementById('startBtnContainer');
            const actionBtns = document.getElementById('actionButtonsContainer');

            const holdReason = document.getElementById('holdReasonContainer');
            const goToTaskBtn = document.getElementById('goToTaskBtnContainer');
            const continueTaskBtn = document.getElementById('continueTaskBtnContainer');
            const rejectedStartBtn = document.getElementById('rejectedStartBtnContainer');

            // Section visibility controls for "in checking" status
            const defaultNotesSection = document.getElementById('defaultNotesSection');
            const adminNotesSection = document.getElementById('adminNotesSection');
            const videoAttachmentsSection = document.getElementById('videoAttachmentsSection');
            const fileAttachmentsSection = document.getElementById('fileAttachmentsSection');
            const defaultFooterAlert = document.getElementById('defaultFooterAlert');
            const checkingFooterAlert = document.getElementById('checkingFooterAlert');

            // Reset all specific classes first
            header.classList.remove('in-progress', 'on-hold', 'rejected', 'done');

            // Hide all action areas by default
            startBtn.style.display = 'none';
            actionBtns.style.display = 'none';
            holdReason.style.display = 'none';
            goToTaskBtn.style.display = 'none';
            continueTaskBtn.style.display = 'none';
            if (rejectedStartBtn) rejectedStartBtn.style.display = 'none';

            // Reset all section visibility
            if (defaultNotesSection) defaultNotesSection.style.display = 'block';
            if (adminNotesSection) adminNotesSection.style.display = 'none';
            if (videoAttachmentsSection) videoAttachmentsSection.style.display = 'none';
            if (fileAttachmentsSection) fileAttachmentsSection.style.display = 'none';
            if (defaultFooterAlert) defaultFooterAlert.style.display = 'flex';
            if (checkingFooterAlert) checkingFooterAlert.style.display = 'none';

            if (isOnHold) {
                header.classList.add('on-hold');
                holdReason.style.display = 'block';
                // Don't show button yet - wait for all checkboxes to be checked
                goToTaskBtn.style.display = 'none';

                // Track which button should be shown
                window.buttonsToShow = {
                    actionButtons: false,
                    startBtn: false,
                    rejectedStartBtn: false,
                    goToTaskBtn: true,
                    continueTaskBtn: false
                };

                // Display hold reason if available
                const holdReasonText = element.getAttribute('data-hold-reason') || '';
                const holdReasonTextEl = document.getElementById('holdReasonText');
                if (holdReasonTextEl) {
                    holdReasonTextEl.textContent = holdReasonText || 'No reason provided';
                }

                // Set up checkbox validation for buttons
                setupCheckboxValidation();
            }
            else if (isInProgress) {
                header.classList.add('in-progress');
                // Don't show action buttons yet - wait for all checkboxes to be checked
                actionBtns.style.display = 'none';

                // Track which buttons should be shown
                window.buttonsToShow = {
                    actionButtons: true,
                    startBtn: false,
                    rejectedStartBtn: false,
                    goToTaskBtn: false,
                    continueTaskBtn: false
                };

                // Update badge to show "In Progress"
                const badgeStatus = document.getElementById('badgeStatus');
                if (badgeStatus) {
                    badgeStatus.className = 'badge-custom badge-progress';
                    badgeStatus.innerHTML = '<i class="ti ti-flag"></i> In Progress';
                }

                // Set up checkbox validation for action buttons
                setupCheckboxValidation();
            }
            else if (isChecked) {
                header.classList.add('check-header');
                // Don't show continue button for checking status - will show sign-in popup instead
                // continueTaskBtn.style.display = 'block';

                // Track which button should be shown (if any)
                window.buttonsToShow = {
                    actionButtons: false,
                    startBtn: false,
                    rejectedStartBtn: false,
                    goToTaskBtn: false,
                    continueTaskBtn: false
                };

                // Update badge to show "In Checking"
                const badgeStatus = document.getElementById('badgeStatus');
                if (badgeStatus) {
                    badgeStatus.className = 'badge-custom badge-checked';
                    badgeStatus.innerHTML = '<i class="ti ti-flag"></i> Project is in Checking';
                }

                // No checkboxes in this status, so no validation needed

                // Show "in checking" specific sections
                if (defaultNotesSection) defaultNotesSection.style.display = 'none';
                if (adminNotesSection) adminNotesSection.style.display = 'block';
                if (videoAttachmentsSection) videoAttachmentsSection.style.display = 'block';
                if (fileAttachmentsSection) fileAttachmentsSection.style.display = 'block';
                if (defaultFooterAlert) defaultFooterAlert.style.display = 'none';
                if (checkingFooterAlert) checkingFooterAlert.style.display = 'flex';

                // Populate video link and file attachments from task data
                const videoLink = element.getAttribute('data-video-link') || '';
                const attachmentsJson = element.getAttribute('data-attachments') || '[]';
                let attachmentFiles = [];

                try {
                    attachmentFiles = JSON.parse(attachmentsJson);
                    if (!Array.isArray(attachmentFiles)) {
                        attachmentFiles = [];
                    }
                } catch (e) {
                    attachmentFiles = [];
                }

                // Display video link
                const videoLinkDisplay = document.getElementById('modalVideoLinkDisplay');
                if (videoLinkDisplay) {
                    if (videoLink && videoLink.trim() !== '') {
                        videoLinkDisplay.innerHTML = `<a href="${videoLink}" target="_blank" style="color: #3b82f6; text-decoration: none; word-break: break-all;">${videoLink}</a>`;
                    } else {
                        videoLinkDisplay.textContent = 'Video Link will be here to check the work';
                    }
                }

                // Display file attachments
                const fileAttachmentsList = document.getElementById('modalFileAttachmentsList');
                if (fileAttachmentsList) {
                    fileAttachmentsList.innerHTML = '';

                    if (attachmentFiles && attachmentFiles.length > 0) {
                        attachmentFiles.forEach((filePath, index) => {
                            // filePath is a string path, need to get filename from it
                            const fileName = filePath.split('/').pop() || `File ${index + 1}.pdf`;
                            const baseUrl = '{{ config("app.url") }}';
                            const fullPath = filePath.startsWith('http') ? filePath : baseUrl + '/storage/' + filePath;

                            // Determine file type from extension
                            const fileExt = fileName.split('.').pop().toLowerCase();
                            let iconClass = 'ti-file-type-pdf';
                            let iconColor = '#ef4444';

                            if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
                                iconClass = 'ti-photo';
                                iconColor = '#3b82f6';
                            } else if (fileExt === 'mp4' || fileExt === 'mov') {
                                iconClass = 'ti-video';
                                iconColor = '#8b5cf6';
                            }

                            const fileItem = document.createElement('div');
                            fileItem.style.cssText = 'background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 12px; display: flex; align-items: center; gap: 8px;';
                            fileItem.innerHTML = `
                            <i class="ti ${iconClass}" style="font-size: 20px; color: ${iconColor};"></i>
                            <div style="font-size: 10px; flex: 1;">
                                <div style="font-weight: 600; color: #1e293b; word-break: break-word;">${fileName}</div>
                                <div style="color: #64748b;">File Attachment</div>
                            </div>
                            <a href="${fullPath}" target="_blank" style="color: #3b82f6; text-decoration: none;" title="Download">
                                <i class="ti ti-download" style="font-size: 16px;"></i>
                            </a>
                        `;
                            fileAttachmentsList.appendChild(fileItem);
                        });
                    } else {
                        // Show placeholder if no files
                        fileAttachmentsList.innerHTML = '<div style="color: #94a3b8; font-size: 13px; text-align: center; padding: 20px;">No file attachments</div>';
                    }
                }

                // Set checking duration time (if available, otherwise use placeholder)
                const checkingDurationEl = document.getElementById('modalCheckingDuration');
                if (checkingDurationEl) {
                    // You can get this from task data if available, for now using placeholder
                    checkingDurationEl.textContent = endDate ? endDate + ' - 12:30' : '24.10.2025 - 12:30';
                }
            }
            else if (isRejected) {
                header.classList.add('rejected');

                // Update badge to show "Rejected"
                const badgeStatus = document.getElementById('badgeStatus');
                if (badgeStatus) {
                    badgeStatus.className = 'badge-custom badge-rejected';
                    badgeStatus.innerHTML = '<i class="ti ti-flag"></i> Rejected';
                }

                // Hide rejection reason box (user doesn't need it)
                const rejectionReasonContainer = document.getElementById('rejectionReasonContainer');
                if (rejectionReasonContainer) {
                    rejectionReasonContainer.style.display = 'none';
                }

                // Don't show start task button yet - wait for all checkboxes to be checked
                if (rejectedStartBtn) {
                    rejectedStartBtn.style.display = 'none';
                }

                // Track which button should be shown
                window.buttonsToShow = {
                    actionButtons: false,
                    startBtn: false,
                    rejectedStartBtn: true,
                    goToTaskBtn: false,
                    continueTaskBtn: false
                };

                // Set up checkbox validation for buttons
                setupCheckboxValidation();
            }
            else if (isDone) {
                header.classList.add('done');

                // Update badge to show "In Done"
                const badgeStatus = document.getElementById('badgeStatus');
                if (badgeStatus) {
                    badgeStatus.className = 'badge-custom badge-done';
                    badgeStatus.innerHTML = '<i class="ti ti-flag"></i> In Done';
                }

                // Show done-specific sections
                if (defaultNotesSection) defaultNotesSection.style.display = 'none';
                if (fileAttachmentsSection) {
                    fileAttachmentsSection.style.display = 'block';
                    // Populate file attachments for done status
                    const attachmentsJson = element.getAttribute('data-attachments') || '[]';
                    let attachmentFiles = [];

                    try {
                        attachmentFiles = JSON.parse(attachmentsJson);
                        if (!Array.isArray(attachmentFiles)) {
                            attachmentFiles = [];
                        }
                    } catch (e) {
                        attachmentFiles = [];
                    }

                    const fileAttachmentsList = document.getElementById('modalFileAttachmentsList');
                    if (fileAttachmentsList) {
                        fileAttachmentsList.innerHTML = '';

                        if (attachmentFiles && attachmentFiles.length > 0) {
                            const baseUrl = '{{ config("app.url") }}';
                            attachmentFiles.forEach((filePath, index) => {
                                const fileName = filePath.split('/').pop() || `File ${index + 1}.pdf`;
                                const fullPath = filePath.startsWith('http') ? filePath : baseUrl + '/storage/' + filePath;

                                const fileExt = fileName.split('.').pop().toLowerCase();
                                let iconClass = 'ti-file-type-pdf';
                                let iconColor = '#ef4444';

                                if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
                                    iconClass = 'ti-photo';
                                    iconColor = '#3b82f6';
                                } else if (fileExt === 'mp4' || fileExt === 'mov') {
                                    iconClass = 'ti-video';
                                    iconColor = '#8b5cf6';
                                }

                                const fileItem = document.createElement('div');
                                fileItem.style.cssText = 'background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 12px; display: flex; align-items: center; gap: 8px; margin-bottom: 10px;';
                                fileItem.innerHTML = `
                                <i class="ti ${iconClass}" style="font-size: 20px; color: ${iconColor};"></i>
                                <div style="font-size: 10px; flex: 1;">
                                    <div style="font-weight: 600; color: #1e293b; word-break: break-word;">${fileName}</div>
                                    <div style="color: #64748b;">94 KB of 94 KB</div>
                                </div>
                                <a href="${fullPath}" target="_blank" style="color: #3b82f6; text-decoration: none;" title="Download">
                                    <i class="ti ti-download" style="font-size: 16px;"></i>
                                </a>
                            `;
                                fileAttachmentsList.appendChild(fileItem);
                            });
                        } else {
                            fileAttachmentsList.innerHTML = '<div style="color: #94a3b8; font-size: 13px; text-align: center; padding: 20px;">No file attachments</div>';
                        }
                    }
                }
                if (defaultFooterAlert) defaultFooterAlert.style.display = 'none';

                // Show developer card section (if it exists, we'll add it)
                const developerCardSection = document.getElementById('developerCardSection');
                if (developerCardSection) {
                    developerCardSection.style.display = 'block';
                }
            }
            else {
                // Default / New
                // Don't show start button yet - wait for all checkboxes to be checked
                startBtn.style.display = 'none';

                // Track which button should be shown
                window.buttonsToShow = {
                    actionButtons: false,
                    startBtn: true,
                    rejectedStartBtn: false,
                    goToTaskBtn: false,
                    continueTaskBtn: false
                };

                // Reset badge to default
                const badgeStatus = document.getElementById('badgeStatus');
                if (badgeStatus) {
                    badgeStatus.className = 'badge-custom badge-new';
                    badgeStatus.innerHTML = '<i class="ti ti-flag"></i> New Task';
                }

                // Set up checkbox validation for buttons
                setupCheckboxValidation();
            }

            // Image - Use the image path that PHP already prepared (from issue or task)
            const imgEl = document.getElementById('modalTaskImageFull');
            const placeholderEl = document.getElementById('modalImagePlaceholder');

            // Store issues for modal image click
            console.log('=== Storing issues ===');
            console.log('Raw issuesJson:', issuesJson);
            console.log('Type:', typeof issuesJson);

            if (issuesJson && issuesJson !== '[]' && issuesJson !== 'null' && issuesJson.trim() !== '') {
                try {
                    // Handle case where it might be double-encoded
                    let parsed = issuesJson;
                    if (typeof issuesJson === 'string') {
                        parsed = JSON.parse(issuesJson);
                        // If still a string, parse again
                        if (typeof parsed === 'string') {
                            parsed = JSON.parse(parsed);
                        }
                    }
                    window.currentTaskIssues = Array.isArray(parsed) ? parsed : [];
                    window.currentFullTaskId = fullTaskId;
                    console.log('✅ Successfully stored issues:', window.currentTaskIssues);
                    console.log('Number of issues:', window.currentTaskIssues.length);
                } catch (e) {
                    console.error('❌ Error parsing issues:', e);
                    console.error('Raw value:', issuesJson);
                    window.currentTaskIssues = [];
                }
            } else {
                console.log('⚠️ No issues JSON or empty');
                window.currentTaskIssues = [];
            }

            // Check if imageSrc is valid (not empty and not just the storage path)
            const productionUrl = "https://logiadmin.it-supportline.de/";

            function normalizeImageSrc(src) {
                if (!src || src.trim() === '') return '';

                // ✅ Local URLs ko production se replace karo
                const localPatterns = [
                    /^http:\/\/127\.0\.0\.1:\d+\//,
                    /^http:\/\/localhost:\d+\//,
                    /^http:\/\/localhost\//,
                ];

                for (const pattern of localPatterns) {
                    if (pattern.test(src)) {
                        // Local base URL hata ke production laga do
                        return src.replace(pattern, productionUrl);
                    }
                }

                // Agar already production URL hai
                if (src.startsWith(productionUrl)) {
                    return src;
                }

                // Relative path hai toh production laga do
                const cleanSrc = src.startsWith('/') ? src.slice(1) : src;
                return productionUrl + cleanSrc;
            }

            const normalizedImageSrc = normalizeImageSrc(imageSrc);

            const isValidImageSrc = normalizedImageSrc !== '' &&
                normalizedImageSrc !== productionUrl + 'storage/' &&
                !normalizedImageSrc.endsWith('/storage/');

            console.log('Original imageSrc:', imageSrc);
            console.log('Normalized imageSrc:', normalizedImageSrc);

            if (isValidImageSrc) {
                imgEl.src = normalizedImageSrc;  // ✅ Ab production URL use hoga
                imgEl.title = normalizedImageSrc;
                imgEl.style.display = 'block';
                placeholderEl.style.display = 'none';

                imgEl.onerror = function() {
                    this.style.display = 'none';
                    placeholderEl.style.display = 'block';
                };

                imgEl.onload = function() {
                    this.style.display = 'block';
                    placeholderEl.style.display = 'none';
                    setTimeout(function() {
                        createIssueBadges();
                    }, 300);
                };

                if (imgEl.complete && imgEl.naturalHeight !== 0) {
                    imgEl.style.display = 'block';
                    placeholderEl.style.display = 'none';
                    setTimeout(function() {
                        createIssueBadges();
                    }, 300);
                }
            } else {
                imgEl.style.display = 'none';
                placeholderEl.style.display = 'block';
            }

            // Show task detail modal
            const myModal = new bootstrap.Modal(document.getElementById('taskDetailModal'));

            // Listen for modal shown event
            const modalElement = document.getElementById('taskDetailModal');
            modalElement.addEventListener('shown.bs.modal', function() {
                // Create badges after modal is fully shown
                setTimeout(function() {
                    createIssueBadges();
                }, 200);
            }, { once: true });

            myModal.show();
        }

        // New Functions for Start Task Flow
        function openStartConfirmationModal() {
            // Close detail modal
            const detailModalEl = document.getElementById('taskDetailModal');
            const detailModal = bootstrap.Modal.getInstance(detailModalEl);
            if (detailModal) {
                detailModal.hide();
            }

            // Set date in confirmation modal
            const today = new Date();
            const formattedDate = today.getDate() + '.' + (today.getMonth() + 1) + '.' + today.getFullYear();
            document.getElementById('confirmStartDate').textContent = formattedDate;

            // Open confirmation modal
            const confirmModal = new bootstrap.Modal(document.getElementById('startConfirmationModal'));
            confirmModal.show();
        }

        function confirmStartTask() {
            if (!window.currentTaskIdForStart) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/tasks/update/${window.currentTaskIdForStart}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    status: 'in_progress'
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Success - Reload page (standard practice here as requested to "move" task)
                        // Or we could update UI locally, but reloading ensures full state sync
                        window.location.reload();
                    } else {
                        alert('Failed to start task. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred.');
                });
        }

        function updateTaskStatus(newStatus) {
            // Reuse for explicit calls if needed
            executeStatusUpdate(newStatus);
        }

        // --- Hold Flow ---
        function openHoldModal() {
            // Close detail modal first
            const detailModalEl = document.getElementById('taskDetailModal');
            const detailModal = bootstrap.Modal.getInstance(detailModalEl);
            if (detailModal) {
                detailModal.hide();
            }

            const now = new Date();
            document.getElementById('holdDateDisplay').textContent = now.toLocaleDateString('de-DE'); // format dd.mm.yyyy
            document.getElementById('holdTimeDisplay').textContent = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

            const holdModal = new bootstrap.Modal(document.getElementById('holdConfirmationModal'));
            holdModal.show();
        }

        function confirmMoveToHold() {
            const holdReasonSelect = document.getElementById('holdReasonSelect');
            const holdReason = holdReasonSelect ? holdReasonSelect.value : '';

            if (!holdReason || holdReason === '') {
                alert('Please select a hold reason');
                return;
            }

            executeStatusUpdate('on_hold', { hold_reason: holdReason });
        }

        // --- Check Flow ---
        function openCheckModal() {
            // Close detail modal first
            const detailModalEl = document.getElementById('taskDetailModal');
            const detailModal = bootstrap.Modal.getInstance(detailModalEl);
            if (detailModal) {
                detailModal.hide();
            }

            const now = new Date();
            document.getElementById('checkDateDisplay').textContent = now.toLocaleDateString('de-DE');
            document.getElementById('checkTimeDisplay').textContent = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

            // Reset video link input
            const videoLinkInput = document.getElementById('checkVideoLink');
            if (videoLinkInput) {
                videoLinkInput.value = '';
            }

            const checkModal = new bootstrap.Modal(document.getElementById('checkConfirmationModal'));
            checkModal.show();
        }

        function confirmMoveToCheck() {
            // Get video link
            const videoLink = document.getElementById('checkVideoLink')?.value || '';

            // Collect all uploaded files from file inputs
            const fileInputs = document.querySelectorAll('#checkConfirmationModal .file-upload-input');
            const uploadedFiles = [];
            fileInputs.forEach(input => {
                if (input.files && input.files.length > 0) {
                    uploadedFiles.push(input.files[0]);
                }
            });

            // Execute update with files
            executeStatusUpdateWithFiles('checked', {
                video_link: videoLink
            }, uploadedFiles);
        }

        // File upload functions
        function triggerFileUpload(box) {
            const input = box.querySelector('.file-upload-input');
            if (input) {
                input.click();
            }
        }

        function handleFileUpload(input, event) {
            const file = event.target.files[0];
            if (!file) return;

            const box = input.closest('.add-file-box');
            if (!box) return;

            // Validate file type
            const allowedTypes = ['pdf', 'jpg', 'jpeg', 'png', 'mp4'];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (!allowedTypes.includes(fileExtension)) {
                alert('Invalid file type. Allowed: PDF, JPG, PNG, MP4');
                input.value = ''; // Clear the input
                return;
            }

            // Validate file size (10MB max)
            const maxSize = 10 * 1024 * 1024; // 10MB
            if (file.size > maxSize) {
                alert('File size too large. Maximum size is 10MB');
                input.value = ''; // Clear the input
                return;
            }

            // Convert box to file display box
            const fileSize = (file.size / 1024).toFixed(0);
            const fileName = file.name.length > 15 ? file.name.substring(0, 15) + '...' : file.name;

            // Determine icon based on file type
            let iconClass = 'ti-file';
            let iconColor = '#64748b';
            if (fileExtension === 'pdf') {
                iconClass = 'ti-file-type-pdf';
                iconColor = '#ef4444';
            } else if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
                iconClass = 'ti-photo';
                iconColor = '#3b82f6';
            } else if (fileExtension === 'mp4') {
                iconClass = 'ti-video';
                iconColor = '#8b5cf6';
            }

            // Store the file reference in the box for later upload
            box.dataset.fileName = file.name;
            box.dataset.fileSize = fileSize;

            box.innerHTML = `
            <i class="ti ${iconClass}" style="font-size: 20px; color: ${iconColor};"></i>
            <div style="font-size: 10px; flex: 1;">
                <div style="font-weight: 600; color: #1e293b;">${fileName}</div>
                <div style="color: #64748b;">${fileSize} KB</div>
            </div>
            <i class="ti ti-trash" style="font-size: 16px; color: #ef4444; cursor: pointer;" onclick="removeFile(this)"></i>
        `;
            box.style.background = '#fff';
            box.style.border = '1px solid #e2e8f0';
            box.style.borderStyle = 'solid';
            box.style.padding = '8px 12px';
            box.style.flexDirection = 'row';
            box.style.gap = '8px';
            box.style.minWidth = '140px';
            box.classList.remove('add-file-box');
            box.classList.add('uploaded-file-box');

            // Keep the input element for file access
            box.appendChild(input);
            input.style.display = 'none';
        }

        function removeFile(icon) {
            const box = icon.closest('.uploaded-file-box, #existingFileBox');
            if (box) {
                box.remove();
            }
        }

        function continueTask() {
            executeStatusUpdate('in_progress');
        }

        // Core AJAX function
        function executeStatusUpdate(newStatus, extraData = {}) {
            if (!window.currentTaskIdForStart) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const requestBody = {
                status: newStatus,
                ...extraData
            };

            fetch(`/tasks/update/${window.currentTaskIdForStart}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(requestBody)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert('Failed to update task status.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred updating status.');
                });
        }

        // AJAX function with file uploads
        function executeStatusUpdateWithFiles(newStatus, extraData = {}, files = []) {
            if (!window.currentTaskIdForStart) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Use FormData if files are present, otherwise use JSON
            if (files && files.length > 0) {
                const formData = new FormData();
                formData.append('status', newStatus);

                // Add extra data
                Object.keys(extraData).forEach(key => {
                    if (extraData[key] !== null && extraData[key] !== undefined) {
                        formData.append(key, extraData[key]);
                    }
                });

                // Add files
                files.forEach((file, index) => {
                    formData.append(`attachment_files[${index}]`, file);
                });

                fetch(`/tasks/update/${window.currentTaskIdForStart}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                        // Don't set Content-Type for FormData, browser will set it with boundary
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Failed to update task status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred updating status.');
                    });
            } else {
                // No files, use regular JSON request
                executeStatusUpdate(newStatus, extraData);
            }
        }

        // Issue Popup Functions
        function openIssuesPopup(imgElement, issuesJson, taskId) {
            let issues = [];
            try {
                issues = issuesJson ? JSON.parse(issuesJson) : [];
            } catch (e) {
                console.error('Error parsing issues:', e);
                issues = [];
            }

            if (!issues || issues.length === 0) {
                alert('No issues available for this task.');
                return;
            }

            // Store current task ID
            window.currentFullTaskId = taskId;
            window.currentTaskIssues = issues;

            // Populate issues list
            const issuesContainer = document.getElementById('issuesListContainer');
            issuesContainer.innerHTML = '';

            issues.forEach((issue, index) => {
                const issueItem = document.createElement('div');
                issueItem.className = 'note-item';
                issueItem.style.cursor = 'pointer';
                issueItem.onclick = function() {
                    openIssueDetail(index);
                };
                issueItem.innerHTML = `
                <div class="note-content">
                    <i class="ti ti-bolt note-icon"></i> Issue ${index + 1}
                </div>
                <i class="ti ti-chevron-right" style="color: #94a3b8;"></i>
            `;
                issuesContainer.appendChild(issueItem);
            });

            // Show modal
            const issuesModal = new bootstrap.Modal(document.getElementById('issuesSelectionModal'));
            issuesModal.show();
        }

        function openModalIssuesPopup() {
            // Use stored issues and task ID from task modal
            if (!window.currentTaskIssues || window.currentTaskIssues.length === 0) {
                alert('No issues available for this task.');
                return;
            }

            // Populate issues list
            const issuesContainer = document.getElementById('issuesListContainer');
            issuesContainer.innerHTML = '';

            window.currentTaskIssues.forEach((issue, index) => {
                const issueItem = document.createElement('div');
                issueItem.className = 'note-item';
                issueItem.style.cursor = 'pointer';
                issueItem.onclick = function() {
                    openIssueDetail(index);
                };
                issueItem.innerHTML = `
                <div class="note-content">
                    <i class="ti ti-bolt note-icon"></i> Issue ${index + 1}
                </div>
                <i class="ti ti-chevron-right" style="color: #94a3b8;"></i>
            `;
                issuesContainer.appendChild(issueItem);
            });

            // Show modal
            const issuesModalEl = document.getElementById('issuesSelectionModal');
            const issuesModal = new bootstrap.Modal(issuesModalEl);
            issuesModal.show();
        }

        function openIssueDetail(issueIndex) {
            if (!window.currentTaskIssues || !window.currentTaskIssues[issueIndex]) {
                alert('Issue not found.');
                return;
            }

            const issue = window.currentTaskIssues[issueIndex];

            // Close issues selection modal if open
            const issuesModalEl = document.getElementById('issuesSelectionModal');
            const issuesModal = bootstrap.Modal.getInstance(issuesModalEl);
            if (issuesModal) {
                issuesModal.hide();
            }

            // Populate issue details
            document.getElementById('issueDetailTitle').textContent = issue.title || 'No Title';
            document.getElementById('issueDetailDescription').textContent = issue.description || 'No description available.';

            console.log('issue data', issue);

            // Get accent color for overlay
            const accent = issue.color || '#ef4444';

            // Build markImageUrl
            let markImageUrl = '';
            const markImagePath = issue.mark_image_path || '';
            const requiredBaseUrl = 'https://logiadmin.it-supportline.de/';

            if (markImagePath) {

                // Agar already correct domain se start ho raha hai
                if (markImagePath.startsWith(requiredBaseUrl)) {
                    markImageUrl = markImagePath;
                }
                // Agar http/https hai lekin required domain nahi hai
                else if (markImagePath.startsWith('http://') || markImagePath.startsWith('https://')) {
                    const cleanPath = markImagePath.replace(/^https?:\/\/[^\/]+/, '');
                    markImageUrl = requiredBaseUrl.replace(/\/$/, '') + cleanPath;
                }
                // Agar storage/ se start ho raha hai
                else if (markImagePath.startsWith('storage/')) {
                    markImageUrl = requiredBaseUrl.replace(/\/$/, '') + '/' + markImagePath;
                }
                // Agar sirf relative path hai
                else {
                    const cleanPath = markImagePath.replace(/^\/+/, '');
                    markImageUrl = requiredBaseUrl.replace(/\/$/, '') + '/storage/' + cleanPath;
                }
            }


            console.log('markImageUrl:', markImageUrl);

            // Get issue position and shape data (normalize shape for comparison)
            const issuePos = issue.position || {};
            const issueShape = (issue.shape && String(issue.shape).toLowerCase()) || 'circle';

            // Get saved width and height, or use defaults
            const issueWidth = (issue.position && issue.position.width) ? issue.position.width : (issueShape === 'circle' ? 80 : 80);
            const issueHeight = (issue.position && issue.position.height) ? issue.position.height : (issueShape === 'circle' ? 80 : 80);

            // Position is stored as center point, so we need to calculate top-left corner
            const issueCenterX = issuePos.left || 0;
            const issueCenterY = issuePos.top || 0;
            const issueLeft = issueCenterX - (issueWidth / 2);
            const issueTop = issueCenterY - (issueHeight / 2);

            // Get layer dimensions for scaling
            const layerW = (issue.layer && issue.layer.width) ? issue.layer.width : 800;
            const layerH = (issue.layer && issue.layer.height) ? issue.layer.height : 600;

            console.log('Layer dimensions:', layerW, 'x', layerH);
            console.log('Issue position:', {issueLeft, issueTop, issueWidth, issueHeight});

            // Create image with marked area visualization
            let imageHtml = '';
            if (markImageUrl) {
                // Create a container with the image and overlay showing the marked area
                const displayWidth = 400; // Fixed width for popup
                const displayHeight = (displayWidth / layerW) * layerH;
                const scaleX = displayWidth / layerW;
                const scaleY = displayHeight / layerH;

                const overlayLeft = issueLeft * scaleX;
                const overlayTop = issueTop * scaleY;
                const overlayWidth = issueWidth * scaleX;
                const overlayHeight = issueHeight * scaleY;

                console.log('Overlay position:', {overlayLeft, overlayTop, overlayWidth, overlayHeight});

                let shapeOverlay = '';
                if (issueShape === 'circle') {
                    const radius = Math.min(overlayWidth, overlayHeight) / 2;
                    shapeOverlay = '<div style="position:absolute; left:' + overlayLeft + 'px; top:' + overlayTop + 'px; width:' + (radius * 2) + 'px; height:' + (radius * 2) + 'px; border:3px solid ' + accent + '; border-radius:50%; box-shadow:0 0 0 2px rgba(255,255,255,0.8), 0 0 10px rgba(0,0,0,0.3); pointer-events:none; z-index:10;"></div>';
                } else if (issueShape === 'square' || issueShape === 'rectangle') {
                    shapeOverlay = '<div style="position:absolute; left:' + overlayLeft + 'px; top:' + overlayTop + 'px; width:' + overlayWidth + 'px; height:' + overlayHeight + 'px; border:3px solid ' + accent + '; box-shadow:0 0 0 2px rgba(255,255,255,0.8), 0 0 10px rgba(0,0,0,0.3); pointer-events:none; z-index:10;"></div>';
                } else if (issueShape === 'triangle') {
                    // Triangle shape - create using SVG
                    const centerX = overlayLeft + overlayWidth / 2;
                    const centerY = overlayTop + overlayHeight / 2;
                    const size = Math.max(overlayWidth, overlayHeight);
                    shapeOverlay = '<svg style="position:absolute; left:' + (centerX - size/2) + 'px; top:' + (centerY - size/2) + 'px; width:' + size + 'px; height:' + size + 'px; pointer-events:none; z-index:10;"><polygon points="' + (size/2) + ',0 ' + size + ',' + size + ' 0,' + size + '" fill="none" stroke="' + accent + '" stroke-width="3" style="filter:drop-shadow(0 0 2px rgba(0,0,0,0.3));"/></svg>';
                } else {
                    // Default to circle
                    const radius = Math.min(overlayWidth, overlayHeight) / 2;
                    shapeOverlay = '<div style="position:absolute; left:' + overlayLeft + 'px; top:' + overlayTop + 'px; width:' + (radius * 2) + 'px; height:' + (radius * 2) + 'px; border:3px solid ' + accent + '; border-radius:50%; box-shadow:0 0 0 2px rgba(255,255,255,0.8), 0 0 10px rgba(0,0,0,0.3); pointer-events:none; z-index:10;"></div>';
                }

                imageHtml = '<div style="display:inline-block; margin:0 auto; border-radius:8px; overflow:hidden; border:1px solid #e5e7eb; background:#fff;">' +
                    '<div style="position:relative; width:' + displayWidth + 'px; height:' + displayHeight + 'px;">' +
                    '<img src="' + markImageUrl + '" style="width:100%; height:100%; object-fit:contain; display:block;">' +
                    shapeOverlay +
                    '</div>' +
                    '</div>';
            }

            console.log('imageHtml generated:', imageHtml ? 'Yes' : 'No');

            // ⭐ SET IMAGE HTML INTO MODAL
            const issueImageBox = document.getElementById('issueImageBox');
            if (imageHtml && imageHtml.length > 0) {
                issueImageBox.innerHTML = imageHtml;
                issueImageBox.style.display = 'block';
                console.log('Image box set to display:block');
            } else {
                issueImageBox.innerHTML = '';
                issueImageBox.style.display = 'none';
                console.log('No image to display');
            }

            // Format dates
            let startDate = '-';
            let endDate = '-';
            if (issue.start_date) {
                try {
                    const start = new Date(issue.start_date);
                    startDate = start.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
                } catch (e) {
                    startDate = issue.start_date;
                }
            }
            if (issue.end_date) {
                try {
                    const end = new Date(issue.end_date);
                    endDate = end.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
                } catch (e) {
                    endDate = issue.end_date;
                }
            }

            document.getElementById('issueDetailStartDate').textContent = startDate;
            document.getElementById('issueDetailEndDate').textContent = endDate;

            const dotEl = document.getElementById('issueAccentDot');
            dotEl.style.background = issue.color || '#ef4444';

            // Show issue detail modal with backdrop
            const detailModalEl = document.getElementById('issueDetailModal');
            const detailModal = new bootstrap.Modal(detailModalEl, {
                backdrop: true,
                keyboard: true
            });

            // Enhance backdrop when modal is shown
            detailModalEl.addEventListener('shown.bs.modal', function handleModalShown() {
                setTimeout(function() {
                    const backdrop = document.querySelector('.modal-backdrop.show');
                    if (backdrop) {
                        backdrop.style.backgroundColor = 'rgba(148, 163, 184, 0.75)';
                        backdrop.style.opacity = '1';
                        backdrop.classList.add('issue-modal-backdrop');
                    }

                    // Double check image visibility
                    const imageBox = document.getElementById('issueImageBox');
                    console.log('Modal shown - imageBox display:', imageBox.style.display);
                    console.log('Modal shown - imageBox innerHTML length:', imageBox.innerHTML.length);
                }, 50);

                detailModalEl.removeEventListener('shown.bs.modal', handleModalShown);
            }, { once: true });

            // Also update backdrop before modal shows
            detailModalEl.addEventListener('show.bs.modal', function() {
                setTimeout(function() {
                    const backdrop = document.querySelector('.modal-backdrop.show');
                    if (backdrop) {
                        backdrop.style.backgroundColor = 'rgba(148, 163, 184, 0.75)';
                    }
                }, 10);
            });

            detailModal.show();
        }



        function createIssueBadges() {
            const badgesContainer = document.getElementById('issueBadgesContainer');
            const imageArea = document.getElementById('modalImageArea');

            console.log('=== createIssueBadges called ===');
            console.log('badgesContainer:', badgesContainer);
            console.log('imageArea:', imageArea);
            console.log('window.currentTaskIssues:', window.currentTaskIssues);
            console.log('Type:', typeof window.currentTaskIssues);
            console.log('Is Array:', Array.isArray(window.currentTaskIssues));
            console.log('Length:', window.currentTaskIssues ? window.currentTaskIssues.length : 'N/A');

            if (!badgesContainer) {
                console.error('❌ Badges container not found');
                return;
            }

            if (!imageArea) {
                console.error('❌ Image area not found');
                return;
            }

            if (!window.currentTaskIssues) {
                console.warn('⚠️ window.currentTaskIssues is not defined');
                return;
            }

            if (!Array.isArray(window.currentTaskIssues)) {
                console.warn('⚠️ window.currentTaskIssues is not an array:', window.currentTaskIssues);
                return;
            }

            if (window.currentTaskIssues.length === 0) {
                console.log('ℹ️ No issues to display (empty array)');
                return;
            }

            // Clear existing badges
            badgesContainer.innerHTML = '';

            const issues = window.currentTaskIssues;
            const containerWidth = imageArea.offsetWidth;
            const containerHeight = imageArea.offsetHeight;

            console.log('✅ Creating badges for', issues.length, 'issues');
            console.log('Issues data:', issues);

            // Calculate positions for badges (distribute evenly if no position data)
            issues.forEach((issue, index) => {
                const badgeWrapper = document.createElement('div');
                badgeWrapper.className = 'issue-badge-wrapper';
                badgeWrapper.style.position = 'absolute';
                badgeWrapper.style.top = '0';
                badgeWrapper.style.left = '0';
                badgeWrapper.style.width = '100%';
                badgeWrapper.style.height = '100%';

                // Check if issue has position data
                let topPercent = 20;
                let leftPercent = 20;

                if (issue.position && issue.layer) {
                    // Convert pixel positions to percentages based on layer dimensions
                    const layerWidth = issue.layer.width || containerWidth;
                    const layerHeight = issue.layer.height || containerHeight;
                    const leftPx = issue.position.left || 0;
                    const topPx = issue.position.top || 0;

                    // Convert to percentage
                    leftPercent = (leftPx / layerWidth) * 100;
                    topPercent = (topPx / layerHeight) * 100;

                    console.log(`Issue ${index + 1} - Layer: ${layerWidth}x${layerHeight}, Position: ${leftPx},${topPx} => ${leftPercent.toFixed(2)}%, ${topPercent.toFixed(2)}%`);
                } else if (issue.position) {
                    // If position exists but no layer, assume pixels relative to container
                    const leftPx = issue.position.left || 0;
                    const topPx = issue.position.top || 0;
                    leftPercent = (leftPx / containerWidth) * 100;
                    topPercent = (topPx / containerHeight) * 100;
                } else if (issue.x !== undefined && issue.y !== undefined) {
                    // Use x, y coordinates if available (assuming percentages)
                    leftPercent = issue.x;
                    topPercent = issue.y;
                } else {
                    // Default pattern: distribute badges across the image
                    const totalIssues = issues.length;
                    const row = Math.floor(index / 3); // 3 badges per row
                    const col = index % 3;
                    topPercent = 20 + (row * 30); // Start at 20%, space every 30%
                    leftPercent = 20 + (col * 25); // Start at 20%, space every 25%

                    // Clamp to reasonable values
                    if (topPercent > 80) topPercent = 80;
                    if (leftPercent > 80) leftPercent = 80;
                }

                // Create badge
                const badge = document.createElement('div');
                badge.className = 'issue-badge';
                badge.textContent = issue.number || (index + 1);
                badge.style.top = topPercent + '%';
                badge.style.left = leftPercent + '%';
                badge.style.transform = 'translate(-50%, -50%)'; // Center the badge
                badge.style.position = 'absolute';
                badge.style.zIndex = '100';
                badge.onclick = function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    openIssueDetail(index);
                };

                badgeWrapper.appendChild(badge);
                badgesContainer.appendChild(badgeWrapper);

                console.log(`✅ Created badge ${badge.textContent} at ${topPercent.toFixed(2)}%, ${leftPercent.toFixed(2)}%`);
                console.log(`Badge element:`, badge);
                console.log(`Badge computed style:`, window.getComputedStyle(badge));
            });

            console.log('✅ Total badges created:', issues.length);
            console.log('Badges container children:', badgesContainer.children.length);
            console.log('Container dimensions:', badgesContainer.offsetWidth, 'x', badgesContainer.offsetHeight);
            console.log('Image area dimensions:', imageArea.offsetWidth, 'x', imageArea.offsetHeight);

            // Force visibility
            badgesContainer.style.display = 'block';
            badgesContainer.style.visibility = 'visible';
            badgesContainer.style.opacity = '1';
        }

        // Function to check if all required checkboxes are checked
        function checkAllCheckboxesChecked() {
            const requiredCheckboxes = document.querySelectorAll('#defaultNotesSection .required-checkbox');

            if (requiredCheckboxes.length === 0) {
                return false;
            }

            // Check if all checkboxes are checked
            let allChecked = true;
            requiredCheckboxes.forEach(checkbox => {
                if (!checkbox.checked) {
                    allChecked = false;
                }
            });

            // Get all button containers
            const actionButtonsContainer = document.getElementById('actionButtonsContainer');
            const startBtnContainer = document.getElementById('startBtnContainer');
            const rejectedStartBtnContainer = document.getElementById('rejectedStartBtnContainer');
            const goToTaskBtnContainer = document.getElementById('goToTaskBtnContainer');
            const continueTaskBtnContainer = document.getElementById('continueTaskBtnContainer');

            // Store which buttons should be shown (based on data attributes or container visibility intent)
            // We'll use a global variable to track which buttons should be shown for current status
            if (!window.buttonsToShow) {
                window.buttonsToShow = {
                    actionButtons: false,
                    startBtn: false,
                    rejectedStartBtn: false,
                    goToTaskBtn: false,
                    continueTaskBtn: false
                };
            }

            if (allChecked) {
                // Show buttons that should be visible for current status
                if (window.buttonsToShow.actionButtons && actionButtonsContainer) {
                    actionButtonsContainer.style.display = 'flex';
                }
                if (window.buttonsToShow.startBtn && startBtnContainer) {
                    startBtnContainer.style.display = 'block';
                }
                if (window.buttonsToShow.rejectedStartBtn && rejectedStartBtnContainer) {
                    rejectedStartBtnContainer.style.display = 'block';
                }
                if (window.buttonsToShow.goToTaskBtn && goToTaskBtnContainer) {
                    goToTaskBtnContainer.style.display = 'block';
                }
                if (window.buttonsToShow.continueTaskBtn && continueTaskBtnContainer) {
                    continueTaskBtnContainer.style.display = 'block';
                }
            } else {
                // Hide all buttons
                if (actionButtonsContainer) actionButtonsContainer.style.display = 'none';
                if (startBtnContainer) startBtnContainer.style.display = 'none';
                if (rejectedStartBtnContainer) rejectedStartBtnContainer.style.display = 'none';
                if (goToTaskBtnContainer) goToTaskBtnContainer.style.display = 'none';
                if (continueTaskBtnContainer) continueTaskBtnContainer.style.display = 'none';
            }

            return allChecked;
        }

        // Function to set up checkbox validation
        function setupCheckboxValidation() {
            const defaultNotesSection = document.getElementById('defaultNotesSection');

            // Only proceed if notes section is visible
            if (!defaultNotesSection || defaultNotesSection.style.display === 'none') {
                // No checkboxes section, show buttons immediately
                showButtonsForCurrentStatus();
                return;
            }

            const requiredCheckboxes = document.querySelectorAll('#defaultNotesSection .required-checkbox');

            // If no checkboxes found, show buttons immediately
            if (requiredCheckboxes.length === 0) {
                showButtonsForCurrentStatus();
                return;
            }

            // Initially hide all buttons (they'll show when all checkboxes are checked)
            const actionButtonsContainer = document.getElementById('actionButtonsContainer');
            const startBtnContainer = document.getElementById('startBtnContainer');
            const rejectedStartBtnContainer = document.getElementById('rejectedStartBtnContainer');
            const goToTaskBtnContainer = document.getElementById('goToTaskBtnContainer');
            const continueTaskBtnContainer = document.getElementById('continueTaskBtnContainer');

            if (actionButtonsContainer) actionButtonsContainer.style.display = 'none';
            if (startBtnContainer) startBtnContainer.style.display = 'none';
            if (rejectedStartBtnContainer) rejectedStartBtnContainer.style.display = 'none';
            if (goToTaskBtnContainer) goToTaskBtnContainer.style.display = 'none';
            if (continueTaskBtnContainer) continueTaskBtnContainer.style.display = 'none';

            // Add event listeners to all required checkboxes
            // Using a named function to allow removal if needed
            requiredCheckboxes.forEach(checkbox => {
                // Remove existing listener if any (using data attribute to track)
                if (checkbox.dataset.listenerAttached === 'true') {
                    return; // Already has listener
                }

                checkbox.addEventListener('change', function() {
                    checkAllCheckboxesChecked();
                });

                // Mark as having listener attached
                checkbox.dataset.listenerAttached = 'true';
            });

            // Check initial state (in case some are pre-checked)
            // Use a small delay to ensure DOM is ready
            setTimeout(function() {
                checkAllCheckboxesChecked();
            }, 100);
        }

        // Helper function to show buttons for current status (when no checkboxes exist)
        function showButtonsForCurrentStatus() {
            if (!window.buttonsToShow) {
                return;
            }

            const actionButtonsContainer = document.getElementById('actionButtonsContainer');
            const startBtnContainer = document.getElementById('startBtnContainer');
            const rejectedStartBtnContainver = document.getElementById('rejectedStartBtnContainer');
            const goToTaskBtnContainer = document.getElementById('goToTaskBtnContainer');
            const continueTaskBtnContainer = document.getElementById('continueTaskBtnContainer');

            if (window.buttonsToShow.actionButtons && actionButtonsContainer) {
                actionButtonsContainer.style.display = 'flex';
            }
            if (window.buttonsToShow.startBtn && startBtnContainer) {
                startBtnContainer.style.display = 'block';
            }
            if (window.buttonsToShow.rejectedStartBtn && rejectedStartBtnContainer) {
                rejectedStartBtnContainer.style.display = 'block';
            }
            if (window.buttonsToShow.goToTaskBtn && goToTaskBtnContainer) {
                goToTaskBtnContainer.style.display = 'block';
            }
            if (window.buttonsToShow.continueTaskBtn && continueTaskBtnContainer) {
                continueTaskBtnContainer.style.display = 'block';
            }
        }


    </script>
