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
