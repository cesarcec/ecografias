<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Cita Médica</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #fff; /* Fondo blanco para impresión */
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%; /* Ajuste para imprimir en horizontal */
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; /* Para alinear el logo y el título */
        }
        /* Encabezado */
        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative; /* Para alinear el logo y el título */
        }
        .title {
            font-size: 24px;
            color: #01366e;
            margin: 0;
            position: absolute;
            top: 30px; /* Alineación vertical */
            left: 20px; /* Alineación horizontal */
        }
        .logo {
            max-width: 150px;
            position: absolute;
            top: 20px; /* Alineación vertical */
            right: 20px; /* Alineación horizontal */
        }
        /* Contenido */
        .content {
            margin-bottom: 20px;
            margin-top: 100px;
        }
        .table-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden; /* Para contener el borde al rededor de la tabla */
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table th, .table td {
            padding: 8px; /* Reducir el padding para achicar el tamaño de la tabla */
            border: 1px solid #ddd;
        }
        .table th {
            background-color: #f4f4f4;
            text-align: left;
            font-weight: bold;
        }
        .requirements {
            padding: 10px;
            font-size: 14px;
            text-align: center;
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
        }
        /* Pie de página */
        .footer {
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            color: #666;
            font-size: 0.9em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">Detalle de Cita Médica</h1>
            <img src="{{asset('assets/img/cedisa_logo_final-01.svg')}}" alt="Logo de la Clínica" class="logo">
        </div>
        <div class="content">
            <div class="table-container">
                <table class="table">
                    <tr>
                        <th>Nro. de cita</th>
                        <td>{{ $orden->id }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de la Cita</th>
                        <td>{{ $orden->fecha_cita }}</td>
                    </tr>
                    <tr>
                        <th>Fecha Programada</th>
                        <td>{{ $orden->fecha_programada }}</td>
                    </tr>
                    <tr>
                        <th>Hora</th>
                        <td>{{ $orden->hora }}</td>
                    </tr>
                    <tr>
                        <th>Estado de la Orden</th>
                        <td>{{ $orden->estado_orden }}</td>
                    </tr>
                    <tr>
                        <th>Paciente</th>
                        <td>{{ $orden->paciente->nombre. ' '  . $orden->paciente->paterno}}</td>
                    </tr>
                    <tr>
                        <th>Doctor programado</th>
                        <td>{{ $orden->doctor->nombre . ' '  . $orden->doctor->paterno }}</td>
                    </tr>
                    <tr>
                        <th>Estudio a realizar</th>
                        <td>{{ $orden->estudio->nombre }}</td>
                    </tr>
                    <tr>
                        <th>Recepcionista de atención</th>
                        <td>{{ $orden->recepcionista->nombre. ' ' . $orden->recepcionista->paterno }}</td>
                    </tr>
                    <!-- Requisitos para cumplir la cita -->
                    <tr>
                        <th colspan="2" class="requirements">Requisitos para cumplir la cita: Traer CI, exámenes médicos si aplica, llegar 20 minutos antes</th>
                    </tr>
                </table>
            </div>
        </div>
        <div class="footer">
            <p>Este comprobante ha sido generado por el sistema de gestión de citas médicas.</p>
        </div>
    </div>
</body>
</html>
