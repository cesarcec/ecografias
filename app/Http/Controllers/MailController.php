<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\HolaMundo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function send(Request $request){
        $asunto = $request->get('asunto');
        $correoDestino = $request->get('email_receptor');
        // $correoDestino = $request->input('email_receptor');
        //$mensaje = $request->input('mensaje');
        $mensaje = $request->get('mensaje');
        try {
            // Envía el correo utilizando la clase Mail y el Mailable (EnviarCorreo)
            Mail::to($correoDestino)->send(new HolaMundo($asunto, $mensaje));
            return response()->json(['message' => "Correo enviado correctamente a $correoDestino"], 200);
        } catch (\Exception $e) {
            // Si ocurre una excepción, significa que el envío del correo falló
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
