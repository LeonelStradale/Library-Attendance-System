<?php

use App\Http\Controllers\AssistantController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LockerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('/assistants', AssistantController::class);

Route::resource('/attendances', AttendanceController::class);

Route::resource('/lockers', LockerController::class);