<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EnvioResultadoController;
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
Route::get('/paciente/citas/{id}', [PacienteController::class, 'citas']);

Route::get('/recepcionista', [RecepcionistaController::class, 'index']);
Route::post('/recepcionista/store', [RecepcionistaController::class, 'store']);
Route::put('/recepcionista/update/{id}', [RecepcionistaController::class, 'update']);
Route::put('/recepcionista/destroy/{id}', [RecepcionistaController::class, 'destroy']);
Route::put('/recepcionista/restore/{id}', [RecepcionistaController::class, 'restore']);
Route::get('/recepcionista/disabled', [RecepcionistaController::class, 'disabled']);

Route::get('/repartidor', [RepartidorController::class, 'index']);
Route::post('/repartidor/store', [RepartidorController::class, 'store']);
Route::put('/repartidor/update/{id}', [RepartidorController::class, 'update']);
Route::put('/repartidor/destroy/{id}', [RepartidorController::class, 'destroy']);
Route::put('/repartidor/restore/{id}', [RepartidorController::class, 'restore']);
Route::get('/repartidor/disabled', [RepartidorController::class, 'disabled']);


Route::get('/tipo_estudio', [TipoEstudioController::class, 'index']);
Route::post('/tipo_estudio/store', [TipoEstudioController::class, 'store']);
Route::put('/tipo_estudio/update/{id}', [TipoEstudioController::class, 'update']);
Route::put('/tipo_estudio/destroy/{id}', [TipoEstudioController::class, 'destroy']);
Route::put('/tipo_estudio/restore/{id}', [TipoEstudioController::class, 'restore']);
Route::get('/tipo_estudio/disabled', [TipoEstudioController::class, 'disabled']);

Route::get('/sala', [SalaController::class, 'index']);
Route::post('/sala/store', [SalaController::class, 'store']);
Route::put('/sala/update/{id}', [SalaController::class, 'update']);
Route::put('/sala/destroy/{id}', [SalaController::class, 'destroy']);
Route::put('/sala/restore/{id}', [SalaController::class, 'restore']);
Route::get('/sala/disabled', [SalaController::class, 'disabled']);

Route::get('/estudio', [EstudioController::class, 'index']);
Route::post('/estudio/store', [EstudioController::class, 'store']);
Route::put('/estudio/update/{id}', [EstudioController::class, 'update']);
Route::put('/estudio/destroy/{id}', [EstudioController::class, 'destroy']);
Route::put('/estudio/restore/{id}', [EstudioController::class, 'restore']);
Route::get('/estudio/disabled', [EstudioController::class, 'disabled']);

Route::get('/orden', [OrdenExamenController::class, 'index']);
Route::post('/orden/store', [OrdenExamenController::class, 'store']);
Route::put('/orden/update/{id}', [OrdenExamenController::class, 'update']);
Route::put('/orden/destroy/{id}', [OrdenExamenController::class, 'destroy']);
Route::put('/orden/restore/{id}', [OrdenExamenController::class, 'restore']);
Route::get('/orden/disabled', [OrdenExamenController::class, 'disabled']);

Route::get('/examen', [ExamenController::class, 'index']);
Route::post('/examen/store', [ExamenController::class, 'store']);
Route::put('/examen/update/{id}', [ExamenController::class, 'update']);
Route::put('/examen/destroy/{id}', [ExamenController::class, 'destroy']);
Route::put('/examen/restore/{id}', [ExamenController::class, 'restore']);
Route::get('/examen/disabled', [ExamenController::class, 'disabled']);

Route::get('/resultado', [ResultadoController::class, 'index']);
Route::post('/resultado/store', [ResultadoController::class, 'store']);
Route::put('/resultado/update/{id}', [ResultadoController::class, 'update']);
Route::put('/resultado/destroy/{id}', [ResultadoController::class, 'destroy']);
Route::put('/resultado/restore/{id}', [ResultadoController::class, 'restore']);
Route::get('/resultado/disabled', [ResultadoController::class, 'disabled']);
Route::get('/resultado/paciente/{id_paciente}', [ResultadoController::class, 'resultadoPaciente']);

Route::get('/envio', [EnvioResultadoController::class, 'index']);
Route::post('/envio/store', [EnvioResultadoController::class, 'store']);
Route::put('/envio/update/{id}', [EnvioResultadoController::class, 'update']);
Route::put('/envio/destroy/{id}', [EnvioResultadoController::class, 'destroy']);
Route::put('/envio/restore/{id}', [EnvioResultadoController::class, 'restore']);
Route::get('/envio/disabled', [EnvioResultadoController::class, 'disabled']);
Route::get('/envio/paciente/{id_paciente}', [EnvioResultadoController::class, 'envioPaciente']);

Route::get('/user-rol', [UserController::class, 'userRol']);
Route::get('/rol-users', [RolController::class, 'rolUsers']);
