@extends('ecografias.cliente_web.layout')

@section('container')
    <table class="table">
        <table id="table" data-search="true" data-side-pagination="server" data-pagination="true">
            <thead>
                <tr>
                    <th data-field="id">Nro de envio</th>
                    <th data-field="resultado_id">Nro de resultado</th>
                    <th data-field="ubicacion.latitud">Latitud</th>
                    <th data-field="ubicacion.longitud">Longitud</th>
                    <th data-field="ubicacion.referencia">Referencia</th>
                    <th data-field="estado_envio">Estado de envio</th>
                    <th data-field="repartidor.user.name">Repartidor</th>
                    <th data-field="resultado.informe">Informe</th>
                    <th data-field="resultado.conclusion">Conclusiones</th>
                    <th data-field="resultado.recomendacion">Recomendaciones</th>
                    <th data-field="resultado.fecha">Fecha</th>
                    {{-- <th data-field="action">Acciones</th> --}}
                </tr>
            </thead>
        </table>
    </table>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="{{ asset('plantilla/css/dropify/dropify.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('class/urlLocal.js') }}"></script>
    <script src="{{ asset('class/apiClient.js') }}"></script>
    <script src="{{ asset('class/crudHandler.js') }}"></script>
    <script src="{{ asset('plantilla/js/dropify/dropify.min.js') }}"></script>
    <script> const pacienteId = {{Auth::user()->load('paciente')->paciente->id}}</script>

    <script src="{{ asset('cliente_web/js/envio.js') }}"></script>


@endsection