<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\MeetingsController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\TicketController;
use App\Models\Notification;

Route::get('deals-dashboard', [CustomAuthController::class, 'deals-dashboard']);
//  Route::get('index', [CustomAuthController::class, 'index'])->name('index');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::post('profile-completion', [CustomAuthController::class, 'completeprofile'])->name('profile.complete');
Route::get('register', [CustomAuthController::class, 'register'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::post('/logout', [CustomAuthController::class, 'signOut'])->name('logout');

//  users

Route::post('/store', [UsersController::class, 'store'])->name('user.store');
Route::get('/user/delete/{id}', [UsersController::class, 'destroy'])->name('user.destroy');
Route::get('/users', [UsersController::class, 'index'])->middleware('auth')->name('chat-users');

Route::get('/home', [UsersController::class, 'home'])->middleware('auth')->name('home');
Route::get('/', [UsersController::class, 'home'])->middleware('auth');

Route::get('/expired-todo', [TodoController::class, 'checkexpired'])->name('todos.expired');

Route::middleware(['auth'])->group(function () {
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::post('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
    Route::post('/todosupdate/{id}', [TodoController::class, 'update'])->name('todos.update');
    Route::post('/todosremove', [TodoController::class, 'remove'])->name('todos.remove');
    Route::get('/deltodo', [TodoController::class, 'deltodo']);
    Route::post('/todoss/complete', [TodoController::class, 'complete'])->name('todos.complete');
    Route::get('/download/{id}', [TodoController::class, 'download'])->name('todos.download');

    
    

    Route::get('/meetings', [MeetingsController::class, 'index'])->name('chat-meetings');
    
    // Chat Routes
    Route::get('/chat', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::post('/meetings', [MeetingsController::class, 'store'])->name('meetings.store');
    Route::post('/meetings/{id}/accept', [MeetingsController::class, 'acceptMeeting'])->name('meetings.accept');
    Route::post('/meetings/{id}/reject', [MeetingsController::class, 'rejectMeeting'])->name('meetings.reject');
    Route::post('/meetingsremove', [MeetingsController::class, 'remove'])->name('meetings.remove');
    Route::post('/meetingspostpone', [MeetingsController::class, 'postpone'])->name('meetings.postpone');
    Route::get('/delmeetings', [MeetingsController::class, 'delmeetings']);
    Route::get('/getmeeting/{id}', [MeetingsController::class, 'getmeeting'])->name('meetings.view');
  // Page View

// Ticket Routes - Read-only access
Route::get('/ticket', [TicketController::class, 'index'])->name('chat-ticket');

// API Routes needed for the page to load data
Route::get('/tickets/stats', [TicketController::class, 'getDashboardStats'])->name('tickets.stats');
Route::get('/tickets/by-status', [TicketController::class, 'getTicketsByStatus'])->name('tickets.filter');
Route::get('/tickets/projects', [TicketController::class, 'projects'])->name('tickets.projects');

// Chat API Routes
Route::middleware('auth')->group(function () {
    Route::get('/api/chat/token', [\App\Http\Controllers\ChatController::class, 'getToken'])->name('chat.token');
    Route::get('/api/chat/groups', [\App\Http\Controllers\ChatController::class, 'getGroups'])->name('chat.groups');
    Route::get('/api/chat/group/{groupId}/messages', [\App\Http\Controllers\ChatController::class, 'getGroupMessages'])->name('chat.group.messages');
    Route::post('/api/chat/group/message', [\App\Http\Controllers\ChatController::class, 'saveGroupMessage'])->name('chat.group.message.save');
    Route::get('/api/chat/group/{groupId}/members', [\App\Http\Controllers\ChatController::class, 'getGroupMembers'])->name('chat.group.members');
    Route::get('/api/user/{userId}/profile', [\App\Http\Controllers\ChatController::class, 'getUserProfile'])->name('user.profile');
});




    });


/*
Route::get('/meetings', function () {
    return view('Chats.meetings');
})->middleware('auth')->name('chat-meetings');
*/




Route::get('/login', function () {


 $response = Http::withOptions([
        'verify' => false, // ✅ disable SSL verification (local only)
    ])->get('https://admin.onlinesystems.info/api/settings/policy');

    if ($response->successful()) {
        $policy = $response->json(); // Decode JSON response
        $policyTerm = $policy['policy_term'] ?? 'No policy found';
    } else {
        $policyTerm = 'Failed to load policy';
    }

$response = Http::withOptions([
        'verify' => false, // ✅ disable SSL verification (local only)
    ])->get('https://admin.onlinesystems.info/api/settings/agreement');

    if ($response->successful()) {
        $agreement = $response->json(); // Decode JSON response
        $agreement_text = $agreement['agreement_text'] ?? 'No agreement found';
    } else {
        $agreement_text = 'Failed to load agreement';
    }


    return view('signin', compact('policyTerm', 'agreement_text'));


})->name("login");






Route::get('/test-db-data', function () {
    try {
        // Get the MongoDB connection
        $db = DB::connection('mongodb')->getMongoDB();

        // List all collections
        $collections = $db->listCollections();
        $collectionNames = [];
        foreach ($collections as $collection) {
            $collectionNames[] = $collection->getName();
        }

        // Optional: get first 5 documents from 'users' collection
        $users = $db->selectCollection('users')->find([], ['limit' => 5])->toArray();

        return view('test-db-data', [
            'collections' => $collectionNames,
            'users' => $users
        ]);
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Test route to generate notifications (for testing purposes)
Route::get('/generate-test-notifications', function () {
    try {
        $count = request()->get('count', 5);
        $read = filter_var(request()->get('read', false), FILTER_VALIDATE_BOOLEAN);
        
        // Find admin user
        $admin = User::where('email', 'admin@gmail.com')->first();
        if (!$admin) {
            return response()->json(['error' => 'Admin user not found'], 404);
        }
        
        // Find developer user
        $developer = User::where('email', 'developer@gmail.com')
            ->orWhere('type', 'developer')
            ->first();
        
        if (!$developer) {
            return response()->json(['error' => 'Developer user not found'], 404);
        }
        
        $notificationTypes = [
            'task_assigned',
            'task_started',
            'task_on_hold',
            'task_checked',
            'task_delayed',
            'task_rejected',
            'task_completed',
            'task_status_updated',
        ];
        
        $created = 0;
        
        // Generate for admin
        for ($i = 0; $i < $count; $i++) {
            $type = $notificationTypes[array_rand($notificationTypes)];
            Notification::create([
                'user_id' => (string) $admin->_id,
                'type' => $type,
                'title' => ucfirst(str_replace('_', ' ', $type)),
                'message' => "Test notification #" . ($i + 1) . " for Admin",
                'data' => [
                    'project' => 'Test Project ' . ($i + 1),
                    'project_name' => 'Test Project ' . ($i + 1),
                    'ticket_code' => 'TKT-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                    'ticket_id' => 'ticket_' . ($i + 1),
                ],
                'read' => $read,
                'created_by' => (string) $developer->_id,
                'task_id' => 'task_' . ($i + 1),
            ]);
            $created++;
        }
        
        // Generate for developer
        for ($i = 0; $i < $count; $i++) {
            $type = $notificationTypes[array_rand($notificationTypes)];
            Notification::create([
                'user_id' => (string) $developer->_id,
                'type' => $type,
                'title' => ucfirst(str_replace('_', ' ', $type)),
                'message' => "Test notification #" . ($i + 1) . " for Developer",
                'data' => [
                    'project' => 'Test Project ' . ($i + 1),
                    'project_name' => 'Test Project ' . ($i + 1),
                    'ticket_code' => 'TKT-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                    'ticket_id' => 'ticket_' . ($i + 1),
                ],
                'read' => $read,
                'created_by' => (string) $admin->_id,
                'task_id' => 'task_' . ($i + 1),
            ]);
            $created++;
        }
        
        return response()->json([
            'success' => true,
            'message' => "Created {$created} test notifications",
            'admin_notifications' => $count,
            'developer_notifications' => $count,
            'read_status' => $read ? 'read' : 'unread'
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
})->middleware('auth');





Route::get('/chat', function () {
    return view('Chats.chat');
})->middleware('auth')->name('chat.index');

// Route::get('/chat', function () {
//     return view('index');
// })->name('chat');
Route::get('/Ai', function () {
    return view('Chats.Ai');
})->middleware('auth')->name('chat-ai');
use App\Http\Controllers\TaskController;

Route::get('/tasks', [TaskController::class, 'index'])->middleware('auth')->name('chat-task');
Route::post('/tasks/update/{id}', [TaskController::class, 'update'])->middleware('auth')->name('tasks.update');

// Task API Routes
Route::get('/tasks/tickets', [TaskController::class, 'tickets'])->name('tasks.tickets');
Route::get('/webtasks/tickets', [TaskController::class, 'tickets'])->name('webtasks.tickets'); // Reusing same logic

// Notification Routes
Route::post('/notifications/mark-all-read', [TaskController::class, 'markNotificationsAsRead'])->middleware('auth')->name('notifications.mark-all-read');
Route::post('/notifications/{id}/mark-read', [TaskController::class, 'markNotificationAsRead'])->middleware('auth')->name('notifications.mark-read');

// Dummy routes for actions to prevent RouteNotFoundException in view (Read-only)
Route::post('/tasks/store', function() { abort(403); })->name('tasks.store');
Route::delete('/tasks/{id}', function() { abort(403); })->name('tasks.destroy');
Route::post('/webtasks/store', function() { abort(403); })->name('webtasks.store');
Route::delete('/webtasks/{id}', function() { abort(403); })->name('webtasks.destroy');
Route::post('/emptasks/store', function() { abort(403); })->name('emptasks.store');
Route::delete('/emptasks/{id}', function() { abort(403); })->name('emptasks.destroy');

Route::get('/teams', function () {
    return view('Chats.teams');
})->middleware('auth')->name('chat-team');



Route::get('/project', function () {
    return view('Chats.project');
})->name('chat-project');

Route::get('/Apis', function () {
    return view('Chats.Api');
})->name('chat-api');
Route::get('/library', function () {
    return view('Chats.library');
})->name('chat-library');



Route::post('/update-email', [App\Http\Controllers\SettingController::class, 'updateEmail'])->name('chatuser.updateEmail');
Route::post('/update-password', [App\Http\Controllers\SettingController::class, 'updatePassword'])->name('user.updatePassword');
Route::post('/toggle-screen-lock', [App\Http\Controllers\SettingController::class, 'toggleScreenLock'])->name('user.toggleScreenLock');
Route::post('/toggle-two-factor', [App\Http\Controllers\SettingController::class, 'toggleTwoFactor'])->name('user.toggleTwoFactor');
Route::post('/settings/app-logo', [App\Http\Controllers\SettingController::class, 'uploadAppLogo'])->name('settings.uploadAppLogo');
Route::post('/settings/upload-favicon', [App\Http\Controllers\SettingController::class, 'uploadFavIcon'])->name('settings.uploadFavicon');
Route::post('/settings/update-app-title', [App\Http\Controllers\SettingController::class, 'updateAppTitle'])->name('settings.updateAppTitle');
Route::post('/settings/toggle-reaction-notification', [App\Http\Controllers\SettingController::class, 'toggleReactionNotification'])->name('settings.toggleReactionNotification');
Route::post('/settings/login-background', [App\Http\Controllers\SettingController::class, 'uploadLoginBackground'])->name('upload.login.backgrounds');
Route::post('/settings/chat-background', [App\Http\Controllers\SettingController::class, 'uploadchatBackground'])->name('upload.chat.backgrounds');
Route::post('/upload-chat-sounds', [App\Http\Controllers\SettingController::class, 'uploadChatSounds'])->name('upload.chat.sounds');
Route::post('/upload-notification-sounds', [App\Http\Controllers\SettingController::class, 'uploadNotificationSounds'])->name('upload.notification.sounds');
// new editor save endpoints
Route::post('/settings/policy/save', [App\Http\Controllers\SettingController::class, 'savePolicy'])->name('settings.policy.save');
Route::post('/settings/agreement/save', [App\Http\Controllers\SettingController::class, 'saveAgreement'])->name('settings.agreement.save');


Route::get('/all-calls', function () {
    return view('all-calls');
})->name('all-calls');

Route::get('/group-chat', function () {
    return view('group-chat');
})->name('group-chat');

Route::get('/my-status', function () {
    return view('my-status');
})->name('my-status');
Route::get('/status', function () {
    return view('status');
})->name('status');
Route::get('/success', function () {
    return view('success');
})->name('success');
Route::get('/user-status', function () {
    return view('user-status');
})->name('user-status');


Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::get('/reset-password', function () {
    return view('reset-password');
})->name('reset-password');
Route::get('/otp', function () {
    return view('otp');
})->name('otp');
Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot-password');

Route::post('/chatuser/store', [App\Http\Controllers\SettingController::class, 'store'])->name('chatuser.store');
