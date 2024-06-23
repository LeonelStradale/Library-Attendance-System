<?php

use App\Http\Controllers\AssistantController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AttendanceController::class, 'welcome'])->name('welcome');

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

Route::get('/createExternalPeople', [AssistantController::class, 'createExternalPeople'])->name('assistants.createExternalPeople');

Route::post('/storeExternalPeople', [AssistantController::class, 'storeExternalPeople'])->name('assistants.storeExternalPeople');

Route::post('/assistants/search-user', [AssistantController::class, 'searchUser'])->name('assistants.searchUser');

// Attendances
Route::resource('/attendances', AttendanceController::class);

Route::get('/entrance', [AttendanceController::class, 'entrance'])->name('entrance');

Route::get('/exit', [AttendanceController::class, 'exit'])->name('exit');

Route::post('/storeEntrance', [AttendanceController::class, 'storeEntrance'])->name('storeEntrance');

Route::delete('/rollbackEntrance/{id}', [AttendanceController::class, 'rollbackEntrance'])->name('rollbackEntrance');

Route::post('/storeExit', [AttendanceController::class, 'storeExit'])->name('storeExit');

Route::delete('/rollbackExit/{id}', [AttendanceController::class, 'rollbackExit'])->name('rollbackExit');

// Lockers
Route::resource('/lockers', LockerController::class);

// PDF
Route::get('/create-report-general', [PDFController::class, 'reportGeneral'])->name('reportGeneral');

Route::get('/create-report-individual', [PDFController::class, 'reportIndividual'])->name('reportIndividual');