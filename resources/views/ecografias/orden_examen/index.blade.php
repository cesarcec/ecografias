@extends('plantilla/layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
@endsection


@section('contenido')
    <div class="card">
        <div class="card-header pointer-cursor" data-toggle="collapse" data-target="#collapse-form" aria-expanded="false"
            aria-controls="collapse-form">
            <div class="d-flex justify-content-between">
                <h3 class="my-2 mx-2">Ordenes de examen</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="collapse show" id="collapse-form">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fecha_cita">Fecha de Cita</label>
                        <input id="fecha_cita" class="form-control" type="date">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha_programada">Fecha de programación de examen</label>
                        <input id="fecha_programada" class="form-control" type="date">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="hora_inicio">Hora de inicio</label>
                        <input id="hora_inicio" class="form-control" type="time">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hora_fin">Hora de fin</label>
                        <input id="hora_fin" class="form-control" type="time">
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="estado_orden">Estado de orden</label>
                        {{-- <input id="estado_orden" class="form-control" type="text" value="Cita programada"> --}}
                        <select class="form-control" name="estado_orden" id="estado_orden" disabled>
                            <option value="Cita programada">Cita programada</option>
                            <option value="Cita programada">Cita completada</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="paciente_id">Paciente</label>
                        <select class="form-control" name="paciente_id" id="paciente_id"></select>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="doctor_id">Especialista</label>
                        <select class="form-control" name="doctor_id" id="doctor_id"></select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="estudio_id">Estudio</label>
                        <select class="form-control" name="estudio_id" id="estudio_id"></select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="recepcionista_id">Recepcionista</label>
                        <input class="form-control" type="text" value="{{Auth::user()->name}}" disabled>
                        @php
                            $idPersonal = 0;
                            if (Auth::user()->recepcionista) {
                                $idPersonal = Auth::user()->recepcionista->id;
                            } else if (Auth::user()->doctor) {
                                $idPersonal = Auth::user()->doctor->id;
                            }  
                        @endphp
                        <input class="form-control" id="recepcionista_id" type="hidden" value="{{$idPersonal}}" disabled>
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
                            <th data-field="fecha_cita">Fecha cita</th>
                            <th data-field="fecha_programada">Fecha programada</th>
                            <th data-field="hora_inicio">Hora de inicio</th>
                            <th data-field="hora_fin">Hora de fin</th>
                            <th data-field="estado_orden">Estado de cita</th>
                            <th data-field="paciente_nombre">Paciente</th>
                            <th data-field="doctor_nombre">Especialista</th>
                            <th data-field="estudio_nombre">Estudio</th>
                            <th data-field="recepcionista_nombre">Recepcionista</th>
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
                            <th data-field="fecha_cita">Fecha cita</th>
                            <th data-field="fecha_programada">Fecha programada</th>
                            <th data-field="hora_inicio">Hora de inicio</th>
                            <th data-field="hora_fin">Hora de fin</th>
                            <th data-field="estado_orden">Estado de cita</th>
                            <th data-field="paciente_nombre">Paciente</th>
                            <th data-field="doctor_nombre">Especialista</th>
                            <th data-field="estudio_nombre">Estudio</th>
                            <th data-field="recepcionista_nombre">Recepcionista</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <input id="id_edit" type="hidden">
                
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha_cita_edit">Fecha de Cita</label>
                            <input id="fecha_cita_edit" class="form-control" type="date">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_programada_edit">Fecha de programación</label>
                            <input id="fecha_programada_edit" class="form-control" type="date">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="hora_inicio_edit">Hora de inicio</label>
                            <input id="hora_inicio_edit" class="form-control" type="time">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hora_fin_edit">Hora de fin</label>
                            <input id="hora_fin_edit" class="form-control" type="time">
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estado_orden_edit">Estado de orden</label>
                            <input id="estado_orden_edit" class="form-control" type="text" value="Cita programada" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="paciente_id_edit">Paciente</label>
                            <select class="form-control" name="paciente_id_edit" id="paciente_id_edit"></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="doctor_id_edit">Especialista</label>
                            <select class="form-control" name="doctor_id_edit" id="doctor_id_edit"></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="estudio_id_edit">Estudio</label>
                            <select class="form-control" name="estudio_id_edit" id="estudio_id_edit"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group col-md-6">
                            <label for="recepcionista_id_edit">Recepcionista</label>
                            <select class="form-control" name="recepcionista_id_edit" id="recepcionista_id_edit"></select>

                            {{-- <input class="form-control" id="recepcionista_id_edit" type="text" value="{{Auth::user()->name}}"> --}}
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
            <a href="${URL_WEB}orden-cita-medica/${element.id}/comprobante" target="_blank" title="Nota de cita" data-id="${element.id}" class="btn btn-sm btn-primary note my-1"><i class="bi bi-file-earmark-pdf"></i></a>
            <a href="${URL_WEB}examen-cita/${element.id}" title="Realizar examen" data-id="${element.id}" class="btn btn-sm btn-secondary note my-1"><i class="bi bi-lungs"></i></a>`;
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
                "fecha_cita",
                "fecha_programada",
                "hora_inicio",
                "hora_fin",
                "estado_orden",
                "paciente_id",
                "doctor_id",
                "estudio_id",
                "recepcionista_id",
            ],
            loadRelations: true,
            relations: [
                {
                    name: "paciente", // Nombre en relations (index backend)
                    nameSecondary: "paciente", // Nombre en object (index backend)
                    nameIndex: ["nombre"], //nameSecondary + nameIndex
                    selectId: "paciente_id",
                }, 
                {
                    name: "doctor", 
                    nameSecondary: "doctor", 
                    nameIndex: ["nombre"], 
                    selectId: "doctor_id",
                },
                {
                    name: "estudio", 
                    nameSecondary: "estudio", 
                    nameIndex: ["nombre"], 
                    selectId: "estudio_id",
                },
                {
                    name: "recepcionista", 
                    nameSecondary: "recepcionista", 
                    nameIndex: ["nombre"], 
                    selectId: "recepcionista_id",
                },
            ],
            formatAction: formatAction,
            formatActionRestore: formatActionRestore,
        };

        const crudHandler = new CrudHandler(apiClient, "orden", config);

        document.addEventListener("DOMContentLoaded", () => {
            crudHandler.init();
        });
    </script>
@endsection
