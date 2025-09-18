<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UsersController;
use App\Models\User;
use App\Http\Controllers\KeywordController;
use App\Models\Setting;


Route::get('/settings/policy', [App\Http\Controllers\SettingController::class, 'getPolicy']);
Route::get('/settings/agreement', [App\Http\Controllers\SettingController::class, 'getAgreement']);
