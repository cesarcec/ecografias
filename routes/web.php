<?php

use App\Http\Controllers\Tipo_estudioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RecepcionistaController;
<<<<<<< HEAD
=======
use App\Http\Controllers\UserController;

>>>>>>> 13baf7e0f59c2be5981a4ef7a4191028ba2bdcb8

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

Route::get('/roles', [RolController::class, 'getIndex']);
Route::get('/doctor', [DoctorController::class, 'getIndex']);
Route::get('/paciente', [PacienteController::class, 'getIndex']);
<<<<<<< HEAD
Route::get('/recepcionista', [RecepcionistaController::class, 'getIndex']);
=======
Route::get('/recepcionista', [RecepcionistaController::class, 'getIndex']);
Route::get('/tipo_estudio', [Tipo_estudioController::class, 'getIndex']);
Route::get('/dashboard', [UserController::class, 'getIndex']);
>>>>>>> 13baf7e0f59c2be5981a4ef7a4191028ba2bdcb8
