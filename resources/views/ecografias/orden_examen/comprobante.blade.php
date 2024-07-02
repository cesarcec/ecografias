<!DOCTYPE html>
<html>
<head>
    <title>Comprobante de Cita Médica</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 70%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .header {
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: table;
            width: 100%;
        }
        .header-left {
            display: table-cell;
            vertical-align: middle;
        }
        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
        }
        .header h2 {
            margin: 0;
            font-size: 1.5em;
            color: #007BFF;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            margin: 20px 0;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content th, .content td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .content th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 0.9em;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <h3>Comprobante de Cita Médica</h2>
            </div>
            <div class="header-right">
                <img src="ruta_al_logo_de_la_clinica" alt="Logo de la Clínica">
            </div>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>ID</th>
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
                    <th>ID del Paciente</th>
                    <td>{{ $orden->paciente_id }}</td>
                </tr>
                <tr>
                    <th>ID del Doctor</th>
                    <td>{{ $orden->doctor_id }}</td>
                </tr>
                <tr>
                    <th>ID del Estudio</th>
                    <td>{{ $orden->estudio_id }}</td>
                </tr>
                <tr>
                    <th>ID de la Recepcionista</th>
                    <td>{{ $orden->recepcionista_id }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>Este comprobante ha sido generado por el sistema de gestión de citas médicas.</p>
        </div>
    </div>
</body>
</html>
