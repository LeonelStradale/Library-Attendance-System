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

// Assistants
Route::resource('/assistants', AssistantController::class);

Route::get('/assistants.createTeacher', [AssistantController::class, 'createTeacher'])->name('assistants.createTeacher');

Route::post('assistants/storeTeacher', [AssistantController::class, 'storeTeacher'])->name('assistants.storeTeacher');

Route::get('/assistants.createExternal', [AssistantController::class, 'createExternal'])->name('assistants.createExternal');

Route::post('assistants/storeExternal', [AssistantController::class, 'storeExternal'])->name('assistants.storeExternal');

Route::get('/createExternalPeople', [AttendanceController::class, 'createExternalPeople'])->name('assistants.createExternalPeople');

Route::post('/assistants/search-user', [AssistantController::class, 'searchUser'])->name('assistants.searchUser');

// Attendances
Route::resource('/attendances', AttendanceController::class);

Route::get('/entrance', [AttendanceController::class, 'entrance'])->name('entrance');

Route::get('/exit', [AttendanceController::class, 'exit'])->name('exit');

// Lockers
Route::resource('/lockers', LockerController::class);