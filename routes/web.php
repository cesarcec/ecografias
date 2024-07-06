<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RecepcionistaController;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\OrdenExamenController;
use App\Http\Controllers\TipoEstudioController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\ResultadoController;
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

Route::get('/dashboard', [UserController::class, 'getIndex']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::get('/roles', [RolController::class, 'getIndex']);
    Route::get('/doctor', [DoctorController::class, 'getIndex']);
    Route::get('/paciente', [PacienteController::class, 'getIndex']);
    Route::get('/recepcionista', [RecepcionistaController::class, 'getIndex']);
    Route::get('/repartidor', [RepartidorController::class, 'getIndex']);
    Route::get('/tipo_estudio', [TipoEstudioController::class, 'getIndex']);
    Route::get('/sala', [SalaController::class, 'getIndex']);
    Route::get('/estudio', [EstudioController::class, 'getIndex']);
    Route::get('/resultado', [ResultadoController::class, 'getIndex']);
    Route::get('/resultado-create/{id_examen}', [ResultadoController::class, 'getResultadoCreate']);

    //Citas médicas
    Route::get('/orden', [OrdenExamenController::class, 'getIndex']);
    Route::get('/orden-cita-medica/{id}/comprobante', [OrdenExamenController::class, 'generarComprobantePDF']);
    Route::get('/examen-cita/{id}', [ExamenController::class, 'getRealizarExamen']);
});




