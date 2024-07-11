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
use App\Http\Controllers\ClienteWebController;
use App\Http\Controllers\CorreoController;
use App\Http\Controllers\EnvioResultadoController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Mail\EnviarCorreo;
use App\Mail\HolaMundo;
use Illuminate\Support\Facades\Mail;


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

Route::get('/dashboard', [UserController::class, 'getIndex'])->name('dashboard');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/roles', [RolController::class, 'getIndex']);
    Route::get('/doctor', [DoctorController::class, 'getIndex']);
    Route::get('/paciente', [PacienteController::class, 'getIndex']);
    Route::get('/recepcionista', [RecepcionistaController::class, 'getIndex']);
    Route::get('/repartidor', [RepartidorController::class, 'getIndex']);
    Route::get('/tipo_estudio', [TipoEstudioController::class, 'getIndex']);
    Route::get('/sala', [SalaController::class, 'getIndex']);
    Route::get('/estudio', [EstudioController::class, 'getIndex']);
    
    

    //Citas médicas
    Route::get('/orden', [OrdenExamenController::class, 'getIndex']);
    Route::get('/orden-cita-medica/{id}/comprobante', [OrdenExamenController::class, 'generarComprobantePDF']);
    Route::get('/examen-cita/{id}', [ExamenController::class, 'getRealizarExamen']);
    Route::get('/examen', [ExamenController::class, 'getIndex']);
    
    // Resultados
    Route::get('/resultado', [ResultadoController::class, 'getIndex']);
    Route::get('/resultado-create/{id_examen}', [ResultadoController::class, 'getResultadoCreate']);
    Route::get('/resultado-comprobante/{id}', [ResultadoController::class, 'generarPdf']);
    Route::get('/resultado-comprobante/download/{id}', [ResultadoController::class, 'generarPdfDownload']);
    // Envios
    Route::get('/envio-resultado/pendiente', [EnvioResultadoController::class, 'pendiente']);
    Route::post('/envio-resultado/asignar', [EnvioResultadoController::class, 'asignarRepartidor']);
    Route::get('/envio-resultado/asignado', [EnvioResultadoController::class, 'asignado']);
    Route::post('/envio-resultado/entregar', [EnvioResultadoController::class, 'entregar']);
    Route::get('/envio-resultado/entregados', [EnvioResultadoController::class, 'entregados']);
    Route::post('/envio-resultado/rechazar', [EnvioResultadoController::class, 'rechazar']);
    Route::get('/envio-resultado/rechazados', [EnvioResultadoController::class, 'rechazados']);
    Route::post('/envio-resultado/informe', [EnvioResultadoController::class, 'informe']);

    // Route::get('/envio-resultado/{id}', [EnvioResultadoController::class, 'getResultado'])->name('envio');
    // Route::post('correo-enviar-mensaje', [CorreoController::class, 'enviarCorreo']);
    Route::get('correo-enviar', [CorreoController::class, 'getEnviar']);
    Route::get('correo-enviar-todos', [CorreoController::class, 'getEnviarTodos']);
    Route::get('correo-enviar-todos-resultados', [CorreoController::class, 'getEnviarTodosResultados']);
    

    
});

//Cliente web
Route::get('/cliente-web', [ClienteWebController::class, 'getIndex']);
Route::get('/cliente-citas', [ClienteWebController::class, 'getCitas']);
Route::get('/cliente-resultado/{id}', [ClienteWebController::class, 'getResultado'])->name('resultado');
Route::get('/cliente-resultado-confirmar-envio/{id}', [ClienteWebController::class, 'getShow'])->name('confirmar');
Route::get('/cliente-envios', [ClienteWebController::class, 'getEnvio'])->name('envios');
/*Route::get('/prueba', function(){
    Mail::to('cliente@correo.cedisa.bo')->send(new HolaMundo());
    return 'Correo enviado';
});*/

Route::get('correo-enviar-mensaje', [MailController::class, 'send']);
Route::get('correo-enviar-mensaje-todos', [MailController::class, 'sendAll']);
Route::get('correo-enviar-mensaje-todos-resultados', [MailController::class, 'sendAllResultado']);