<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\EnviarCorreoTodos;
use App\Mail\EnviarCorreoTodosResultado;
use App\Mail\HolaMundo;
use App\Models\Resultado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function send(Request $request){
        $asunto = $request->get('asunto');
        $correoDestino = $request->get('email_receptor');
        $data = [
            'nombre' => $request->get('nombre'),
            'mensaje' => $request->get('mensaje')
        ];
        try {
            // Envía el correo utilizando la clase Mail y el Mailable (EnviarCorreo)
            Mail::to($correoDestino)->send(new HolaMundo($asunto, $data));
            return response()->json(['message' => "Correo enviado correctamente a $correoDestino"], 200);
        } catch (\Exception $e) {
            // Si ocurre una excepción, significa que el envío del correo falló
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function sendAll(Request $request){
        $asunto = $request->get('asunto');
        $mensaje = $request->get('mensaje');
        $users = User::all();
        try {

            foreach ($users as $user){
                $correoDestino = $user->email;
                $email = new EnviarCorreoTodos($asunto, $mensaje);
                Mail::to($correoDestino)->send($email);
            }
            return response()->json(['message' => "Correos enviado correctamente a todos"], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function sendAllResultado(Request $request){
        $asunto = $request->get('asunto');
        $mensaje = $request->get('mensaje');
        $resultados = Resultado::where('estado', 1)
            ->with(
                'examen.ordenExamen.paciente.user', 
                'examen.ordenExamen.doctor.user', 
                'examen.ordenExamen.estudio'
            )->get();
        $remitente = Auth::user()->name;
        try {

            foreach ($resultados as $resultado){
                $user = $resultado->examen->ordenExamen->paciente->user;
                $correoDestino = $user->email;
                $data = [
                    'resultado_id' => $resultado->id,
                    'mensaje' => $mensaje,
                ];
                $email = new EnviarCorreoTodosResultado($remitente, $asunto, $data);
                Mail::to($correoDestino)->send($email);
            }
            return response()->json(['message' => "Correos enviado correctamente a todos"], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
