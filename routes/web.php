<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

 Route::get('deals-dashboard', [CustomAuthController::class, 'deals-dashboard']); 
//  Route::get('index', [CustomAuthController::class, 'index'])->name('index');
 Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
 Route::get('register', [CustomAuthController::class, 'register'])->name('register-user');
 Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
 Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
 Route::post('/logout', [CustomAuthController::class, 'signOut'])->name('logout');

Route::get('/', function () {
    return view('signin');
});

 

Route::get('/index', function () {
    return view('index');
})->middleware('auth')->name('index');

   Route::get('/login', function () {
    return view('signin');
   })->name('login');  



Route::get('/chat', function () {
    return view('index');
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
    return view('Chats.users');
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

Route::get('/settings', function () {
    return view('Chats.settings');
})->name('settings');
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
 


