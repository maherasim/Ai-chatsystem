<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;

Route::get('/settings/policy', [SettingController::class, 'getPolicy']);
Route::get('/settings/agreement', [SettingController::class, 'getAgreement']);
Route::post('/settings/policy', [SettingController::class, 'savePolicy']);
Route::post('/settings/agreement', [SettingController::class, 'saveAgreement']);
