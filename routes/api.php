<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UsersController;
use App\Models\User;
use App\Http\Controllers\KeywordController;
use App\Models\Setting;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProjectController;


Route::get('/settings/policy', [App\Http\Controllers\SettingController::class, 'getPolicy']);
Route::get('/settings/agreement', [App\Http\Controllers\SettingController::class, 'getAgreement']);
// Route::get('/tickets/projects', [TicketController::class, 'projects'])->name('tickets.projects');

// Project details (full) for edit modal prefill
Route::get('/projects/{id}', [ProjectController::class, 'showApi']);
