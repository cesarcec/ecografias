@extends('plantilla/layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
@endsection


@section('contenido')
    <div class="card">
        <div class="card-header pointer-cursor" data-toggle="collapse" data-target="#collapse-form" aria-expanded="false"
            aria-controls="collapse-form">
            <div class="d-flex justify-content-between">
                <h3 class="my-2 mx-2">Estudios</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="collapse show" id="collapse-form">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="descripcion">Descripción</label>
                        <input id="descripcion" class="form-control" type="text">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="requerimientos">Requerimientos</label>
                        <input id="requerimientos" class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="precio">Precio</label>
                        <input id="precio" class="form-control" type="number" step="any">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tipo_estudio_id">Tipo de estudio</label>
                        <select class="form-control" name="tipo_estudio_id" id="tipo_estudio_id"></select>
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
                            <th data-field="nombre">Nombre</th>
                            <th data-field="descripcion">Descripción</th>
                            <th data-field="requerimientos">Requerimientos</th>
                            <th data-field="precio">Precio</th>
                            <th data-field="tipo_estudio_nombre">Tipo de estudio</th>
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
                            <th data-field="nombre">Nombre</th>
                            <th data-field="descripcion">Descripción</th>
                            <th data-field="requerimientos">Requerimientos</th>
                            <th data-field="precio">Precio</th>
                            <th data-field="tipo_estudio_nombre">Tipo de estudio</th>
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
                        <div class="form-group col-md-6">
                            <label for="nombre_edit">Nombre</label>
                            <input id="nombre_edit" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="descripcion_edit">Descripción</label>
                            <input id="descripcion_edit" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="requerimientos_edit">Requerimientos</label>
                            <input id="requerimientos_edit" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="precio_edit">Precio</label>
                            <input id="precio_edit" class="form-control" type="number" step="any">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tipo_estudio_id_edit">Tipo de estudio</label>
                            <select class="form-control" name="tipo_estudio_id_edit" id="tipo_estudio_id_edit"></select>
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
            <button  title="Eliminar" data-id="${element.id}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button>`;
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
                "descripcion",
                "requerimientos",
                "precio",
                "tipo_estudio_id",
            ],
            loadRelations: true,
            relations: [
                {
                    name: "tipo_estudio", // Nombre en relations (index backend)
                    nameSecondary: "tipo_estudio", // Nombre en object (index backend)
                    nameIndex: ["nombre"], //nameSecondary + nameIndex
                    selectId: "tipo_estudio_id",
                }, 
            ],
            formatAction: formatAction,
            formatActionRestore: formatActionRestore,
        };

        const crudHandler = new CrudHandler(apiClient, "estudio", config);

        document.addEventListener("DOMContentLoaded", () => {
            crudHandler.init();
        });
    </script>
@endsection
