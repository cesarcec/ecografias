<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use App\Models\User;

class CorreoController extends Controller
{
    protected $host = '192.168.25.99';

    public function getEnviar()
    {
        return view("ecografias.correo.enviar");
    }

    public function getEnviados()
    {
        return view("ecografias.correo.enviados");
    }

    public function getRecibidos()
    {
        return view("ecografias.correo.recibidos");
    }

    #servidor de correo
    public function postEnviarMensaje(Request $request)
    {

        $mail = new PHPMailer(true);
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

        $usuarioAutenticado = Auth::user();
        $user = User::findOrFail($usuarioAutenticado->id);
        $userId = $user->id;
        
        $emailRemitente = $user->email;
        // $password = $user->password_zentyal;
        $password = 'milanHZ3991';

        $nombreRemitente = $request->get('nombre');
        $emailReceptor = $request->get('email_receptor');
        $asunto = $request->get('asunto');
        $mensaje = $request->get('mensaje');

        try {
            // Configuración del servidor SMTP
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = $this->host;
            $mail->SMTPAuth = true;
            $mail->Username = $emailRemitente;
            $mail->Password = $password;
            // $mail->SMTPSecure = 'tls';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 25;

            $mail->setFrom($emailRemitente, $emailReceptor);
            $mail->addAddress($emailReceptor);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = $mensaje;

            // Enviar el correo
            $mail->send();

            return "Correo enviado correctamente de $nombreRemitente ($emailRemitente) a $emailReceptor";
        } catch (Exception $e) {
            return "Error al enviar el correo: {$e->getMessage()}";
        }
    }

}
