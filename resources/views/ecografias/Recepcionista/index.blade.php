@extends('plantilla/layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
@endsection

@section('contenido')
    <h3 class="my-2 mx-2">Recepcionistas</h1>

        <div class="container">
            <label for="nombre">Nombre</label>
            <input id="nombre" class="form-control" type="text">
            <label for="paterno">Paterno</label>
            <input id="paterno" class="form-control" type="text">
            <label for="materno">Materno</label>
            <input id="materno" class="form-control" type="text">

            <button id="save" class="btn btn-primary my-2">Guardar</button>
        </div>

        <table
            id="table"
            data-search="true"
            data-side-pagination="server"
            data-pagination="true"
        >
            <thead>
                <tr>
                    <th data-field="id">ID</th>
                    <th data-field="nombre">Nombre</th>
                    <th data-field="paterno">Paterno</th>
                    <th data-field="materno">Materno</th>

                    <th data-field="estado">Estado</th>
                    <th data-field="action">Acciones</th>
                </tr>
            </thead>
        </table>

        <hr>
        <h4>Eliminados</h4>
        <table
            id="table-delete"
            data-search="true"
            data-side-pagination="server"
            data-pagination="true"
        >
            <thead>
                <tr>
                    <th data-field="id">ID</th>
                    <th data-field="nombre">Nombre</th>
                    <th data-field="paterno">Paterno</th>
                    <th data-field="materno">Paterno</th>
                    <th data-field="estado">Estado</th>
                    <th data-field="action">Acciones</th>
                </tr>
            </thead>
        </table>


<!-- Modal -->
<div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input id="id_edit" type="hidden">
            <label for="nombre_edit">Nombre</label>
            <input id="nombre_edit" class="form-control" type="text">
            <label for="paterno_edit">Paterno</label>
            <input id="paterno_edit" class="form-control" type="text">
            <label for="materno_edit">Materno</label>
            <input id="materno_edit" class="form-control" type="text">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="update" class="btn btn-primary">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('class/urlLocal.js')}}"></script>
    <script src="{{asset('class/apiCLient.js')}}"></script>
    <script src="{{asset('class/crudHandler.js')}}"></script>


    <script>
        const formatAction = (element) => {
            return `
            <button data-id="${element.id}" class="btn btn-sm btn-warning edit"><i class="bi bi-pencil-fill"></i>Editar</button>
            <button data-id="${element.id}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i>Eliminar</button>`;
        };

        const formatActionRestore = (element) => {
            return `
            <button data-id="${element.id}" class="btn btn-sm btn-info restore"><i class="fa fa-undo"></i>Restaurar</button>`;
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
            ],
            loadRelations: false,
            formatAction: formatAction,
            formatActionRestore: formatActionRestore,
        };

        const crudHandler = new CrudHandler(apiClient, "recepcionista", config);

        document.addEventListener("DOMContentLoaded", () => {
            crudHandler.init();
        });

    </script>
@endsection

