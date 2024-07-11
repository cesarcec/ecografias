<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Correo Informativo CEDISA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .content {
            padding: 20px 0;
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #777;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{asset('assets/img/cedisa_logo_final-01.svg')}}" alt="CEDISA Logo">
            <h1>Correo Informativo CEDISA</h1>
        </div>
        <div class="content">
            <h3>Estimado Usuario,</h3>
            <p>
                Nos complace informarle que ha recibido un nuevo correo de CEDISA con los siguientes datos:
            </p>
            <p>
                <strong>Data:</strong> {{$data}}
            </p>
            <p>
                Si tiene alguna pregunta o necesita más información, no dude en ponerse en contacto con nosotros.
            </p>
            <a href="asset('cliente-web')" class="button">Visitar nuestro sitio web</a>
        </div>
        <div class="footer">
            <p>CEDISA © 2024. Todos los derechos reservados.</p>
            <p>Este correo electrónico fue enviado a varios usuarios de CEDISA. Si no desea recibir más correos, por favor, <a href="https://example.com/unsubscribe" style="color: #007bff;">darse de baja aquí</a>.</p>
        </div>
    </div>
</body>
</html>
