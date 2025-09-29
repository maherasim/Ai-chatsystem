<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UsersController;
use App\Models\User;
use App\Http\Controllers\KeywordController;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route as RouteFacade;
use App\Http\Controllers\TicketController;
Route::get('deals-dashboard', [CustomAuthController::class, 'deals-dashboard']);
//  Route::get('index', [CustomAuthController::class, 'index'])->name('index');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'register'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::post('/logout', [CustomAuthController::class, 'signOut'])->name('logout');

//  users

Route::post('/store', [UsersController::class, 'store'])->name('user.store');
Route::put('/user/{id}', [UsersController::class, 'update'])->name('user.update');
Route::get('/user/delete/{id}', [UsersController::class, 'destroy'])->name('user.destroy');
Route::get('/users', [UsersController::class, 'index'])->middleware('auth')->name('chat-users');
Route::get('/users/check-email', [UsersController::class, 'checkEmail'])->name('users.checkEmail');

Route::get('/', function () {
    return view('signin');
});

// routes/web.php

Route::get('/home', function () {
    $header = Setting::all();
    $setting = Setting::first();
    return view('index', compact('header','setting'));
})->middleware('auth')->name('home');

Route::get('/login', function () {
    return view('signin');
})->name('login');



Route::get('/chat', function () {
    $headers = Setting::all();
    $setting = Setting::first();
    return view('Chats.chat', compact('headers','setting'));
})->middleware('auth')->name('chat.index');

// Route::get('/chat', function () {
//     return view('index');
// })->name('chat');
Route::get('/Ai', function () {
    $headers = Setting::all();
    return view('Chats.Ai', compact('headers'));
})->middleware('auth')->name('chat-ai');
Route::get('/tasks', function () {
    $headers = Setting::all();
    return view('Chats.task', compact('headers'));
})->middleware('auth')->name('chat-task');

Route::get('/ticket', [TicketController::class, 'index'])->middleware('auth')->name('chat-ticket');

// Ticket APIs
Route::middleware('auth')->group(function () {
    Route::get('/api/tickets/projects', [TicketController::class, 'projects'])->name('tickets.projects');
    Route::get('/api/tickets/projects/{projectId}/sections', [TicketController::class, 'projectSections'])->name('tickets.project.sections');
    Route::post('/api/tickets/projects/{projectId}/sections', [TicketController::class, 'addSection'])->name('tickets.project.sections.add');
    Route::post('/api/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/api/tickets', [TicketController::class, 'list'])->name('tickets.list');
});
Route::get('/teams', function () {
    $headers = Setting::all();
    return view('Chats.teams', compact('headers'));
})->middleware('auth')->name('chat-team');
Route::get('/meetings', function () {
    $headers = Setting::all();
    return view('Chats.meetings', compact('headers'));
})->middleware('auth')->name('chat-meetings');

Route::get('/todo', function () {
    $headers = Setting::all();
    return view('Chats.groups', compact('headers'));
})->middleware('auth')->name('chat-groups');
Route::get('/project', [App\Http\Controllers\ProjectController::class, 'index'])->name('chat-project');
Route::post('/project', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');

Route::get('/Apis', function () {
    $headers = Setting::all();
    return view('Chats.Api', compact('headers'));
})->name('chat-api');
Route::get('/library', [App\Http\Controllers\LibraryController::class, 'index'])->name('chat-library');



Route::get('/settings', [App\Http\Controllers\SettingController::class, 'showSettingsForm'])->name('settings');
Route::post('/update-email', [App\Http\Controllers\SettingController::class, 'updateEmail'])->name('chatuser.updateEmail');
Route::post('/update-password', [App\Http\Controllers\SettingController::class, 'updatePassword'])->name('user.updatePassword');
Route::post('/screen-lock/save', [App\Http\Controllers\SettingController::class, 'saveScreenLock'])->name('user.saveScreenLock');
Route::post('/unlock', [App\Http\Controllers\SettingController::class, 'unlockScreen'])->name('user.unlockScreen');
Route::post('/lock', [App\Http\Controllers\SettingController::class, 'lockScreen'])->name('user.lockScreen');
Route::post('/toggle-two-factor', [App\Http\Controllers\SettingController::class, 'toggleTwoFactor'])->name('user.toggleTwoFactor');
Route::post('/settings/app-logo', [App\Http\Controllers\SettingController::class, 'uploadAppLogo'])->name('settings.uploadAppLogo');
Route::post('/settings/upload-favicon', [App\Http\Controllers\SettingController::class, 'uploadFavIcon'])->name('settings.uploadFavicon');
Route::post('/settings/update-app-title', [App\Http\Controllers\SettingController::class, 'updateAppTitle'])->name('settings.updateAppTitle');
Route::post('/settings/toggle-reaction-notification', [App\Http\Controllers\SettingController::class, 'toggleReactionNotification'])->name('settings.toggleReactionNotification');
Route::post('/settings/login-background', [App\Http\Controllers\SettingController::class, 'uploadLoginBackground'])->name('upload.login.backgrounds');
Route::post('/settings/login-background/select', [App\Http\Controllers\SettingController::class, 'selectLoginBackground'])->name('select.login.background');
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

// Locked screen page
Route::get('/locked', function(){
    return view('locked');
})->name('locked.page');


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
Route::get('/headers', [App\Http\Controllers\SettingController::class, 'header'])->name('header');


Route::post('/chatuser/store', [App\Http\Controllers\SettingController::class, 'store'])->name('chatuser.store');
Route::post('/upload-words', [KeywordController::class, 'upload'])->name('upload.words');
 
Route::post('/keywords/{id}', [KeywordController::class, 'update'])->name('keywords.update');
Route::delete('/keywords/{id}', [KeywordController::class, 'destroy'])->name('keywords.destroy');

// test email route
Route::get('/test-email', function () {
    $toEmail = 'asimriazasim107@gmail.com';
    $subject = 'Test Email from Laravel';

    Mail::raw('This is a test email from Laravel.', function ($message) use ($toEmail, $subject) {
        $message->to($toEmail)->subject($subject);
    });

    return 'Test email dispatched';
});