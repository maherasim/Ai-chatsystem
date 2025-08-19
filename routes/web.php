<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostJobController;
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
Route::get('/users', [UsersController::class, 'index'])->middleware('auth')->name('chat-users');

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

Route::get('/meetings', function () {
    return view('Chats.meetings');
})->middleware('auth')->name('chat-meetings');

Route::get('/todo', function () {
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

// Post Job Requests + Bidding
Route::middleware('auth')->group(function () {
    Route::get('/post-job-request', [PostJobController::class, 'index'])->name('post-jobs.index');
    Route::post('/post-job-request', [PostJobController::class, 'store'])->name('post-jobs.store');
    Route::get('/post-job-request/{id}', [PostJobController::class, 'show'])->name('post-jobs.show');

    // Provider bidding
    Route::post('/post-job-request/{id}/bid', [PostJobController::class, 'bid'])->name('post-jobs.bid');

    // User accepts bid
    Route::post('/post-job-request/{jobId}/accept/{bidId}', [PostJobController::class, 'acceptBid'])->name('post-jobs.accept');

    // Provider workflow
    Route::post('/post-job-request/{jobId}/start', [PostJobController::class, 'start'])->name('post-jobs.start');
    Route::post('/post-job-request/{jobId}/user-start', [PostJobController::class, 'userStart'])->name('post-jobs.user-start');
    Route::post('/post-job-request/{jobId}/hold', [PostJobController::class, 'hold'])->name('post-jobs.hold');
    Route::post('/post-job-request/{jobId}/done', [PostJobController::class, 'done'])->name('post-jobs.done');

    // User confirms
    Route::post('/post-job-request/{jobId}/confirm', [PostJobController::class, 'confirm'])->name('post-jobs.confirm');

    // Provider completes or adds extras
    Route::post('/post-job-request/{jobId}/complete', [PostJobController::class, 'completeWithoutExtras'])->name('post-jobs.complete');
    Route::post('/post-job-request/{jobId}/extra-charges', [PostJobController::class, 'addExtraCharges'])->name('post-jobs.extra');

    // Payment
    Route::post('/post-job-request/{jobId}/pay', [PostJobController::class, 'pay'])->name('post-jobs.pay');
});
