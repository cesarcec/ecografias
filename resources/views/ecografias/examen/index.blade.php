@extends('plantilla/layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
@endsection


@section('contenido')
    <div class="card">
        <div class="card-header pointer-cursor" data-toggle="collapse" data-target="#collapse-form" aria-expanded="false"
            aria-controls="collapse-form">
            <div class="d-flex justify-content-between">
                <h3 class="my-2 mx-2">Examen</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="collapse show" id="collapse-form">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="observaciones">Observaciones</label>
                        <textarea class="form-control" name="observaciones" id="observaciones" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Sala</label>
                        <select name="sala_id" id="sala_id" class="form-control"></select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha">Fecha de examen</label>
                        <input id="fecha_programada" value="{{$orden->fecha_programada}}" class="form-control" type="text" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Hora de inicio</label>
                        <input id="hora_inicio" value="{{$orden->hora_inicio}}" class="form-control" type="text" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha">Hora de fin</label>
                        <input id="hora_fin" value="{{$orden->hora_fin}}" class="form-control" type="text" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Paciente" class="form-label">Paciente</label>
                        <input id="paciente" value="{{$orden->paciente->nombre . ' ' . $orden->paciente->paterno}}" class="form-control" type="text" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="doctor" class="form-label">Doctor programado</label>
                        <input id="doctor" value="{{$orden->doctor->nombre . ' ' . $orden->doctor->paterno}}" class="form-control" type="text" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="orden_examen_id" class="form-label">Nro. de orden</label>
                        <input id="orden_examen_id" value="{{$orden->id}}" class="form-control" type="text" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button id="clear" class="btn btn-secondary my-2">Limpiar</button>
                        <button id="save" class="btn btn-primary my-2">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="tablets mt-3">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#tab-index" data-toggle="tab"><i
                                class="bi bi-scissors"></i>&nbsp;&nbsp;Examenes</a>
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
                            <th data-field="sala_nombre">Sala</th>
                            <th data-field="observaciones">Observaciones</th>
                            <th data-field="fecha">Fecha</th>
                            <th data-field="orden_examen.paciente.user.name">Paciente</th>
                            <th data-field="orden_examen.doctor.user.name">Doctor</th>
                            <th data-field="orden_examen_id">Nro de cita</th>
                            <th data-field="action">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane" id="tab-delete">
                <table id="table-delete" data-search="true" data-side-pagination="server" data-pagination="true">
                    <thead>
                        <tr>
                            <th data-field="id">ID</th>
                            <th data-field="sala_nombre">Sala</th>
                            <th data-field="observaciones">Observaciones</th>
                            <th data-field="fecha">Fecha</th>
                            <th data-field="orden_examen.paciente.user.name">Paciente</th>
                            <th data-field="orden_examen.doctor.user.name">Doctor</th>
                            <th data-field="orden_examen_id">Nro de cita</th>
                            <th data-field="action">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>


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
                        <div class="form-group col-md-12">
                            <label for="observaciones_edit">Observaciones</label>
                            <textarea class="form-control" name="observaciones_edit" id="observaciones_edit" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sala_id_edit">Sala</label>
                            <select name="sala_id_edit" id="sala_id_edit" class="form-control"></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_edit">fecha</label>
                            <input id="fecha_edit" class="form-control" type="date">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="orden_examen_id_edit" class="form-label">Nro. de orden</label>
                        <input id="orden_examen_id_edit" value="{{$orden->id}}" class="form-control" type="text" disabled>
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
    <script src="{{ asset('class/apiClient.js') }}"></script>
    <script src="{{ asset('class/crudHandler.js') }}"></script>


    <script>
        const formatAction = (element) => {
            return `
            <button title="Editar" data-id="${element.id}" class="btn btn-sm btn-warning edit"><i class="bi bi-pencil-fill"></i></button>
            <button  title="Eliminar" data-id="${element.id}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button>
            <a href="${URL_WEB}resultado-create/${element.id}" title="Realizar resultado de examen" data-id="${element.id}" class="btn btn-sm btn-primary note my-1"><i class="bi bi-check-circle-fill"></i></a>`;
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
                "observaciones",
                "fecha",
                "orden_examen_id",
                "sala_id",
            ],
            loadRelations: true,
            relations: [
                {
                    name: "salas", // Nombre en relations (index backend)
                    nameSecondary: "sala", // Nombre en object (index backend)
                    nameIndex: ["nombre"], //nameSecondary + nameIndex
                    selectId: "sala_id",
                }, 
            ],
            formatAction: formatAction,
            formatActionRestore: formatActionRestore,
        };

        const crudHandler = new CrudHandler(apiClient, "examen", config);

        document.addEventListener("DOMContentLoaded", () => {
            crudHandler.init();
        });
    </script>
@endsection
