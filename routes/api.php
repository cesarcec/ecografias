<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\DoctorController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/roles', [RolController::class, 'index']);
Route::post('/roles/store', [RolController::class, 'store']);
Route::put('/roles/update/{id}', [RolController::class, 'update']);
Route::put('/roles/destroy/{id}', [RolController::class, 'destroy']);
Route::put('/roles/restore/{id}', [RolController::class, 'restore']);
Route::get('/roles/disabled', [RolController::class, 'disabled']);

Route::get('/doctor', [DoctorController::class, 'index']);
Route::post('/doctor/store', [DoctorController::class, 'store']);
Route::put('/doctor/update/{id}', [DoctorController::class, 'update']);
Route::put('/doctor/destroy/{id}', [DoctorController::class, 'destroy']);
Route::put('/doctor/restore/{id}', [DoctorController::class, 'restore']);
Route::get('/doctor/disabled', [DoctorController::class, 'disabled']);

