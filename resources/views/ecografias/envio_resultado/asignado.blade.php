@extends('plantilla/layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
@endsection


@section('contenido')
    <div class="card">
        <div class="card-header pointer-cursor" data-toggle="collapse" data-target="#collapse-form" aria-expanded="false"
            aria-controls="collapse-form">
            <div class="d-flex justify-content-between">
                <h3 class="my-2 mx-2">Envíos aceptados</h1>
            </div>
        </div>
    </div>

    <section class="tablets mt-3">
        {{-- <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#tab-index" data-toggle="tab"><i
                                class="bi bi-scissors"></i>&nbsp;&nbsp;Especialistas</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#tab-delete" data-toggle="tab"><i
                                class="bi bi-trash"></i>&nbsp;&nbsp;Eliminados</a>
                    </li>
                </ul>
            </div>
        </div> --}}
        <div class="tab-content">
            <div class="active tab-pane" id="tab-index">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col" data-field="fecha">fecha del resultado</th>
                            <th scope="col" data-field="estado_envio">Estado de envío</th>
                            {{-- <th scope="col" data-field="estado_envio">Detalle</th> --}}
                            <th scope="col" data-field="action">Repartidor</th>
                            <th scope="col" data-field="action">Entregar</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($envioResultados as $envioResultado)
                            <tr>
                                <th scope="row">{{ $envioResultado->id }}</th>

                                <td>{{ $envioResultado->fecha }}</td>

                                <td class="text-primary">{{ $envioResultado->estado_envio }}</td>

                                {{-- <td class="text-success">
                                    <!-- Botón con ícono para activar el modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </td> --}}
                                <td>
                                    {{ isset($envioResultado->repartidor->nombre) ? $envioResultado->repartidor->nombre : '' }}
                                </td>
                                <td>
                                    <button data-id-envio="{{ $envioResultado->id }}"
                                        class="entregar btn btn-success">Entregar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('class/urlLocal.js') }}"></script>
    <script src="{{ asset('envio/js/asignado.js') }}"></script>
    {{-- <script src="{{ asset('class/apiCLient.js') }}"></script>
    <script src="{{ asset('class/crudHandler.js') }}"></script> --}}
@endsection
