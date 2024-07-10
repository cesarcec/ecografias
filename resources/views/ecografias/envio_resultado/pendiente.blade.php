@extends('plantilla/layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
@endsection


@section('contenido')
    <div class="card">
        <div class="card-header pointer-cursor" data-toggle="collapse" data-target="#collapse-form" aria-expanded="false"
            aria-controls="collapse-form">
            <div class="d-flex justify-content-between">
                <h3 class="my-2 mx-2">Envíos pendientes</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="collapse show" id="collapse-form">

            </div>
        </div>
    </div>

    <section class="tablets mt-3">
        <div class="card">
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
        </div>
        <div class="tab-content">
            <div class="active tab-pane" id="tab-index">
                <table id="table" data-search="true" data-side-pagination="server" data-pagination="true">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="fecha">fecha del resultado</th>
                            <th data-field="estado_envio">estado de envio</th>
                            <th data-field="action">Asignar Repartidor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($envioResultados as $envioResultado)
                            <tr>
                                <td>{{ $envioResultado->id }}</td>
                            </tr>
                            <tr>
                                {{ $envioResultado->fecha }}
                            </tr>

                            <tr>
                                {{ $envioResultado->estado_envio }}
                            </tr>
                            <tr>
                                <!-- Button asignar repartidor trigger modal -->
                                <button type="button" class="btn nota" data-bs-toggle="modal"
                                    style="background-color: #1C345D;" data-bs-target="#staticBackdrop1"
                                    data-id-cliente = "{{ }}" data-id_pedido="{{ }}">
                                    <i class="fa-solid fa-truck" style="color: red"></i>
                                </button>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="tab-delete">
                <table id="table-delete" data-search="true" data-side-pagination="server" data-pagination="true">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="nombre">Nombre</th>
                            <th data-field="paterno">Paterno</th>
                            <th data-field="materno">Materno</th>
                            <th data-field="especialidad">Especialidad</th>
                            <th data-field="genero">Genero</th>
                            <th data-field="user_email">Correo</th>
                            <th data-field="action">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>


    <!-- Modal repartidor -->
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Lista de repartidores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="background-color: #fff; border:none;"> <i class="fa-solid fa-x"></i></button>
                </div>
                <div class="modal-body mt--4">
                    <table id="datatablesSimple" class="table align-items-center table-flush">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-light">Nombre</th>
                                <th scope="col" class="text-light">Paterno</th>
                                <th scope="col" class="text-light">Tipo de vehículo</th>
                                <th scope="col" class="text-light">descrición</th>
                                <th scope="col" class="text-light">Opción</th>
                                {{-- <th width="1%" class="p-2"></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($repartidores as $repartidor)
                                @if (isset($repartidor->vehiculos[0]))
                                    @if ($repartidor->vehiculos[0]->estado_uso == 'Disponible')
                                        <tr>
                                            <td class="align-middle p-1 pl-2 nombre">{{ $repartidor->nombre }}</td>
                                            <td class="align-middle p-1 pl-3 apellidos">{{ $repartidor->paterno }}</td>
                                            <td class="align-middle pl-3 p-1">
                                                {{ $repartidor->vehiculos[0]->tipovehiculo->descripcion }}
                                            </td>
                                            <td class="align-middle pl-3 p-1">{{ $repartidor->vehiculos[0]->marca }}
                                                {{ $repartidor->vehiculos[0]->modelo }}</td>
                                            <td class="align-middle p-1 text-center">
                                                <input type="radio" name="asignado"
                                                    data-nombre='{{ $repartidor->nombre }}'
                                                    value="{{ $repartidor->id_repartidor }}">
                                            </td>

                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-body mt--4">
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="checkboxRepartidor" checked>
                        <label class="form-check-label" for="checkboxRepartidor">
                            Notificar al repartidor.
                        </label>
                        <textarea id="mensajeRepartidor" class="form-control" style="height: 5rem">Estimado repartidor, por favor, hay un pedido pendiente que necesita tu atención. ¿Podrías encargarte de ello lo antes posible? ¡Gracias!</textarea>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="checkboxCliente" checked>
                        <label class="form-check-label" for="checkboxCliente">
                            Notificar al cliente.
                        </label>
                        <textarea id="mensajeCliente" class="form-control" style="height: 5rem">¡Buenas noticias! Tu pedido está en camino y será entregado pronto. ¡Gracias por elegirnos, esperamos que disfrutes de tu compra!</textarea>
                    </div>

                </div>
                <div class="modal-footer mt--5">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="aceptar"
                        data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>

    </div>



    <!-- Modal -->
    <div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Doctor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <input id="id_edit" type="hidden">

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="nombre_edit">Nombre</label>
                            <input id="nombre_edit" class="form-control" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="paterno_edit">Paterno</label>
                            <input id="paterno_edit" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="materno_edit">Materno</label>
                            <input id="materno_edit" class="form-control" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="especialidad_edit">Especialidad</label>
                            <input id="especialidad_edit" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="genero_edit">Género</label>
                            <input id="genero_edit" class="form-control" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="user_email_edit">Correo</label>
                            <input id="user_email_edit" class="form-control" type="email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="password_edit">Nueva Contraseña</label>
                            <input id="password_edit" class="form-control" type="password">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="update" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('class/urlLocal.js') }}"></script>
    <script src="{{ asset('class/apiCLient.js') }}"></script>
    <script src="{{ asset('class/crudHandler.js') }}"></script>


    <script>
        const formatAction = (element) => {
            return `
            <button data-id="${element.id}" class="btn btn-sm btn-warning edit"><i class="bi bi-pencil-fill"></i> Editar</button>
            <button data-id="${element.id}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i> Eliminar</button>`;
        };

        const formatActionRestore = (element) => {
            return `
            <button data-id="${element.id}" class="btn btn-sm btn-info restore"><i class="fa fa-undo"></i> Restaurar</button>`;
        };

        const apiClient = new ApiClient(URL_API_REST);
        const config = {
            table: $("#table"),
            tableDeletes: $("#table-delete"),
            // loaderObject: loader,
            modalEdit: "modal_edit",
            saveBtn: "save",
            updateBtn: "update",
            editShowBtn: ".edit",
            deleteBtn: ".delete",
            restoreBtn: ".restore",
            labelPrefixEdit: "_edit",
            selectors: [
                "id",
                "nombre",
                "paterno",
                "materno",
                "genero",
                "especialidad",
                "email",
                "user_email",
                "password",
                "password_confirmation"
            ],
            loadRelations: true,
            relations: [{
                name: "user",
                nameSecondary: "user",
                nameIndex: ["email"],
                selectId: "user_id",
            }, ],
            formatAction: formatAction,
            formatActionRestore: formatActionRestore,
            validatePassword: true,
            classErrorInput: 'input-error',
        };

        const crudHandler = new CrudHandler(apiClient, "doctor", config);

        document.addEventListener("DOMContentLoaded", () => {
            crudHandler.init();
        });
    </script>
@endsection
