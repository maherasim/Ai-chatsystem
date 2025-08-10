<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UsersController;
use App\Models\User;

Route::get('deals-dashboard', [CustomAuthController::class, 'deals-dashboard']);
//  Route::get('index', [CustomAuthController::class, 'index'])->name('index');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'register'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::post('/logout', [CustomAuthController::class, 'signOut'])->name('logout');

//  users

Route::post('/store', [UsersController::class, 'store'])->name('user.store');
Route::get('/user/delete/{id}', [UsersController::class, 'destroy'])->name('user.destroy');
Route::get('/', function () {
    return view('signin');
});



Route::get('/home', function () {
    return view('index');
})->middleware('auth')->name('home');

Route::get('/login', function () {
    return view('signin');
})->name('login');



Route::get('/chat', function () {
    return view('Chats.chat');
})->middleware('auth')->name('chat.index');

// Route::get('/chat', function () {
//     return view('index');
// })->name('chat');
Route::get('/Ai', function () {
    return view('Chats.Ai');
})->middleware('auth')->name('chat-ai');
Route::get('/tasks', function () {
    return view('Chats.task');
})->middleware('auth')->name('chat-task');
Route::get('/users', function () {
    $users = User::where('is_admin', '!=', true)
        ->where(function ($q) {
            $q->where('role', '!=', 'admin')->orWhereNull('role');
        })
        ->get();

    $totalUsers = User::where('is_admin', '!=', true)
        ->where(function ($q) {
            $q->where('role', '!=', 'admin')->orWhereNull('role');
        })
        ->count();

    $activeUsers = User::where('is_admin', '!=', true)
        ->where(function ($q) {
            $q->where('role', '!=', 'admin')->orWhereNull('role');
        })
        ->where('active', true)
        ->count();

    $inactiveUsers = User::where('is_admin', '!=', true)
        ->where(function ($q) {
            $q->where('role', '!=', 'admin')->orWhereNull('role');
        })
        ->where('active', false)
        ->count();

    $newJoinersToday = User::where('is_admin', '!=', true)
        ->where(function ($q) {
            $q->where('role', '!=', 'admin')->orWhereNull('role');
        })
        ->whereDate('created_at', \Carbon\Carbon::today())
        ->where('active', true)
        ->count();

    return view('Chats.users', compact('totalUsers', 'activeUsers', 'inactiveUsers', 'newJoinersToday', 'users'));
})->middleware('auth')->name('chat-users');

Route::get('/meetings', function () {
    return view('Chats.meetings');
})->middleware('auth')->name('chat-meetings');

Route::get('/groups', function () {
    return view('Chats.groups');
})->middleware('auth')->name('chat-groups');
Route::get('/project', function () {
    return view('Chats.project');
})->name('chat-project');

Route::get('/Apis', function () {
    return view('Chats.Api');
})->name('chat-api');
Route::get('/library', function () {
    return view('Chats.library');
})->name('chat-library');



Route::get('/settings', [App\Http\Controllers\SettingController::class, 'showSettingsForm'])->name('settings');
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
