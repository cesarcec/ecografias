<?php

use App\Http\Controllers\Tipo_estudioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RecepcionistaController;

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

Route::get('/paciente', [PacienteController::class, 'index']);
Route::post('/paciente/store', [PacienteController::class, 'store']);
Route::put('/paciente/update/{id}', [PacienteController::class, 'update']);
Route::put('/paciente/destroy/{id}', [PacienteController::class, 'destroy']);
Route::put('/paciente/restore/{id}', [PacienteController::class, 'restore']);
Route::get('/paciente/disabled', [PacienteController::class, 'disabled']);



Route::get('/recepcionista', [RecepcionistaController::class, 'index']);
Route::post('/recepcionista/store', [RecepcionistaController::class, 'store']);
Route::put('/recepcionista/update/{id}', [RecepcionistaController::class, 'update']);
Route::put('/recepcionista/destroy/{id}', [RecepcionistaController::class, 'destroy']);
<<<<<<< HEAD
Route::put('/recepcionista/restore/{id}', [RecepcionistaControllerr::class, 'restore']);
Route::get('/recepcionista/disabled', [RecepcionistaController::class, 'disabled']);
=======
Route::put('/recepcionista/restore/{id}', [RecepcionistaController::class, 'restore']);
Route::get('/recepcionista/disabled', [RecepcionistaController::class, 'disabled']);


Route::get('/tipo_estudio', [Tipo_estudioController::class, 'index']);
Route::post('/tipo_estudio/store', [Tipo_estudioController::class, 'store']);
Route::put('/tipo_estudio/update/{id}', [Tipo_estudioController::class, 'update']);
Route::put('/tipo_estudio/destroy/{id}', [Tipo_estudioController::class, 'destroy']);
Route::put('/tipo_estudio/restore/{id}', [Tipo_estudioController::class, 'restore']);
Route::get('/tipo_estudio/disabled', [Tipo_estudioController::class, 'disabled']);
>>>>>>> 13baf7e0f59c2be5981a4ef7a4191028ba2bdcb8
