@extends('plantilla/layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
@endsection


@section('contenido')
    

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
