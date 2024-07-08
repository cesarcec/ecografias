<!-- resources/views/pdf/resultado.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Examen Médico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            /* Para alinear el logo y el título */
        }

        .title {
            font-size: 24px;
            color: #01366e;
            margin: 0;
            position: absolute;
            top: 30px;
            /* Alineación vertical */
            left: 20px;
            /* Alineación horizontal */
        }

        .logo {
            max-width: 150px;
            position: absolute;
            top: 20px;
            /* Alineación vertical */
            right: 20px;
            /* Alineación horizontal */
        }

        .informe {
            margin-bottom: 20px;
        }

        /* .imagenes {
            margin-bottom: 20px;
        } */

        .imagen {
            display: inline-block;
            text-align: center;
            width: 30%;
            /* Ajustar según necesidad */
            height: 200px;
            margin-right: 10px;
            /* Espacio entre imágenes */
            vertical-align: top;
            /* Alineación vertical */
            margin-top: 10px
        }

        .imagen-completa {
            display: inline-block;
            text-align: center;
            width: 100%;
            /* Ajustar según necesidad */
            height: 100%;
            margin-right: 5%;
            /* Espacio entre imágenes */
            vertical-align: top;
            /* Alineación vertical */
        }

        .imagen-completa img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .imagen img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            position: relative;
        }

        .footer-logo {
            max-width: 50px;
            /* Ajusta el tamaño del logo según sea necesario */
            vertical-align: middle;
        }

        .footer-text {
            display: inline-block;
            margin-left: 10px;
            vertical-align: middle;
        }


        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-top: 10px
        }

        /* .table,
        th,
        td {
            border: 1px solid #000;
        } */

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Estilos para la tabla */
        .table-custom {
            border-collapse: collapse;
            background-color: transparent;
            border: none;
            margin-top: 100px
        }

        /* Estilos para las celdas */
        .cell-no-border {
            border: none;
        }

        .cell-padding {
            padding: 8px;
            /* Ajusta el padding según sea necesario */
        }

        .cell-align-left {
            text-align: left;
        }

        /* Estilos para las celdas específicas */
        .cell-bold {
            font-weight: bold;
        }

        .cell-italic {
            font-style: italic;
        }

        /* Estilos para el encabezado de la tabla */
        .table-header {
            background-color: #f2f2f2;
        }

        .col-span-4 {
            width: 100%;
            /* Ocupa todo el ancho disponible */
        }

        .cell-center {
            text-align: center;
        }
        .text-footer {
            margin-top: 2px
        }
    </style>
</head>

<body>
    <div class="header">
        <h1 class="title">Resultado de examen ecográfico</h1>
        <img src="{{ asset('assets/img/cedisa_logo_final-01.svg') }}" alt="Logo de la Clínica" class="logo">
    </div>
    <table class="table-custom table">
        <thead class="table-header">
            <tr>
                <th class="cell-no-border cell-padding cell-bold">Fecha:</th>
                <td class="cell-no-border cell-padding">{{ $resultado->fecha }}</td>
                <th class="cell-no-border cell-padding cell-bold">Número de Resultado:</th>
                <td class="cell-no-border cell-padding">{{ $resultado->id }}</td>
            </tr>
        </thead>
    </table>

    <table class="table">
        <tbody>
            <tr>
                <th class="cell-padding cell-bold cell-center" colspan="4">Detalles del resultado de examen
                    ecográfico</th>
            </tr>
            <tr>
                <th>Número de Examen:</th>
                <td>{{ $resultado->examen->id }}</td>
                <th>Número de Orden:</th>
                <td>{{ $resultado->examen->ordenExamen->id }}</td>
            </tr>
            <tr>
                <th>Paciente:</th>
                <td>{{ $resultado->examen->ordenExamen->paciente->user->name }}</td>
                <th>Doctor:</th>
                <td>{{ $resultado->examen->ordenExamen->doctor->user->name }}</td>
            </tr>
            <tr>
                <th>Recepcionista:</th>
                <td>{{ $resultado->examen->ordenExamen->recepcionista->user->name }}</td>
                <th>Fecha del Examen:</th>
                <td>{{ $resultado->examen->fecha }}</td>
            </tr>
            <tr>
                <th>Fecha de Entrega del Resultado:</th>
                <td>{{ $resultado->fecha }}</td>
                <th>Estudio solicitado:</th>
                <td colspan="3">{{ $resultado->examen->ordenExamen->estudio->nombre }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <tbody>
            <tr>
                <th class="cell-padding cell-bold cell-center" colspan="4">Informe ecográfico</th>
            </tr>
            <tr>
                <td colspan="4">{{ $resultado->informe }}</td>
            </tr>

            <tr>
                <th>Conclusiones</th>
                <td colspan="3">{{ $resultado->conclusion }}</td>
            </tr>
            <tr>
                <th>Recomendaciones</th>
                <td colspan="3">{{ $resultado->recomendacion }}</td>
            </tr>
        </tbody>
    </table>
    <p>Resultado ecográfico:</p>
    {{-- <div class="imagenes"> --}}
    @foreach ([$resultado->imagen_1, $resultado->imagen_2, $resultado->imagen_3] as $imagen)
        @if ($imagen)
            <div class="imagen">
                <img src="{{ asset('assets/img/resultado') }}/{{ $imagen }}" alt="Imagen">
            </div>
        @endif
    @endforeach
    {{-- </div> --}}
    <div class="footer">
        <img src="{{ asset('assets/img/cedisa_logo_final-01.svg') }}" alt="Logo de la Clínica" class="footer-logo">
        <p class="text-footer">Este documento fue generado el {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    @foreach ([$resultado->imagen_1, $resultado->imagen_2, $resultado->imagen_3] as $imagen)
        @if ($imagen)
            <div class="imagen-completa">
                <img src="{{ asset('assets/img/resultado') }}/{{ $imagen }}" alt="Imagen">
                <div class="footer">
                    <img src="{{ asset('assets/img/cedisa_logo_final-01.svg') }}" alt="Logo de la Clínica" class="footer-logo">
                    <p class="text-footer">Este documento fue generado el {{ now()->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
            <div style="page-break-after: always;"></div> {{-- Forzar salto de página --}}
        @endif
    @endforeach
</body>

</html>
