@extends('plantilla/layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
@endsection


@section('contenido')
    <div class="card">
        <div class="card-header pointer-cursor" data-toggle="collapse" data-target="#collapse-form" aria-expanded="false"
            aria-controls="collapse-form">
            <div class="d-flex justify-content-between">
                <h3 class="my-2 mx-2">Repartidores</h1>
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
                        <label for="paterno">Paterno</label>
                        <input id="paterno" class="form-control" type="text">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="materno">Materno</label>
                        <input id="materno" class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telefono">Teléfono</label>
                        <input id="telefono" class="form-control" type="text">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="licencia_conducir">Nro. Licencia de conducir</label>
                        <input id="licencia_conducir" class="form-control" type="text">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Correo</label>
                        <input id="email" class="form-control" type="email">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Contraseña</label>
                        <input id="password" class="form-control" type="password">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Repite la contraseña</label>
                        <input id="password_confirmation" class="form-control" type="password">
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
                            <th data-field="paterno">Paterno</th>
                            <th data-field="materno">Materno</th>
                            <th data-field="telefono">Teléfono</th>
                            <th data-field="licencia_conducir">Nro. Licencia de conducir</th>
                            <th data-field="user_email">Correo</th>
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
                            <th data-field="paterno">Paterno</th>
                            <th data-field="materno">Materno</th>
                            <th data-field="telefono">Teléfono</th>
                            <th data-field="licencia_conducir">Nro. Licencia de conducir</th>
                            <th data-field="user_email">Correo</th>
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
                
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="nombre_edit">Nombre</label>
                            <input id="nombre_edit" class="form-control" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="paterno_edit">Paterno</label>
                            <input id="paterno_edit" class="form-control" type="text">
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="materno_edit">Materno</label>
                            <input id="materno_edit" class="form-control" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="telefono_edit">Teléfono</label>
                            <input id="telefono_edit" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="licencia_conducir">Nro. Licencia de Conducir</label>
                            <input id="licencia_conducir" class="form-control" type="text">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="user_email_edit">Correo</label>
                            <input id="user_email_edit" class="form-control" type="email">
                        </div>
                    </div>
                    <div class="row">
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
                "paterno",
                "materno",
                "telefono",
                "licencia_conducir",
                "email",
                "user_email",
                "password",
                "password_confirmation"
            ],
            loadRelations: true,
            relations: [
                {
                    name: "user",
                    nameSecondary: "user",
                    nameIndex: ["email"],
                    selectId: "user_id",
                }, 
            ],
            formatAction: formatAction,
            formatActionRestore: formatActionRestore,
            validatePassword: true,
            classErrorInput: 'input-error',
        };

        const crudHandler = new CrudHandler(apiClient, "repartidor", config);

        document.addEventListener("DOMContentLoaded", () => {
            crudHandler.init();
        });
    </script>
@endsection
