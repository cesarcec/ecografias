<?php

use App\Http\Controllers\TipoEstudioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RecepcionistaController;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('auth.login');
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
Route::get('/recepcionista', [RecepcionistaController::class, 'getIndex']);
Route::get('/repartidor', [RepartidorController::class, 'getIndex']);
Route::get('/tipo_estudio', [TipoEstudioController::class, 'getIndex']);
Route::get('/estudio', [EstudioController::class, 'getIndex']);


Route::get('/dashboard', [UserController::class, 'getIndex']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
