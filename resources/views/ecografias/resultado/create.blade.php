@extends('plantilla/layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="{{ asset('plantilla/css/dropify/dropify.min.css') }}">
@endsection


@section('contenido')
    <div class="card">
        <div class="card-header pointer-cursor" data-toggle="collapse" data-target="#collapse-form" aria-expanded="false"
            aria-controls="collapse-form">
            <div class="d-flex justify-content-between">
                <h3 class="my-2 mx-2">Resultados</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="collapse show" id="collapse-form">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="informe">Informe ecográfico</label>
                        <textarea name="informe" id="informe" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="conclusion">Conclusiones</label>
                        <textarea name="conclusion" id="conclusion" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="recomendacion">Recomendaciones</label>
                        <textarea name="recomendacion" id="recomendacion" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="fecha">fecha de resultado</label>
                        <input id="fecha" class="form-control" value="" type="date"> 
                    </div>
                    <div class="form-group col-md-4">
                        <label for="observacion">Estudio realizado</label>
                        <input id="observacion" class="form-control" value="{{$examen->ordenExamen->estudio->nombre}}" type="text" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="observacion">Observaciones en examen</label>
                        <input id="observacion" class="form-control" value="{{$examen->observaciones}}" type="text" disabled>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="examen_id">Nro de examen</label>
                        <input id="examen_id" class="form-control" value="{{$examen->id}}" type="text" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-12">Imagenes de la ecografía:</p>
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="form-group mt-2 mb-3 col-lg-4 col-md-12 col-sm-12">
                                <input type="file" id="imagen_1" name="imagen_1" class="dropify">
                                <small id="fileHelp" class="form-text text-muted">Inserta imágenes menores a 5 Megabytes</small>
                            </div>
                            <div class="form-group mt-2 mb-3 col-lg-4 col-md-6 col-sm-12">
                                <input type="file" id="imagen_2" class="dropify">
                                <small id="fileHelp" class="form-text text-muted">Inserta imágenes menores a 5 Megabytes</small>
                            </div>
                            <div class="form-group mt-2 mb-3 col-lg-4 col-md-6 col-sm-12">
                                <input type="file" id="imagen_3" class="dropify">
                                <small id="fileHelp" class="form-text text-muted">Inserta imágenes menores a 5 Megabytes</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button id="clear" class="btn btn-secondary my-2">Limpiar</button>
                        <button id="save-custom" class="btn btn-primary my-2">Guardar</button>
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
    <script src="{{ asset('plantilla/js/dropify/dropify.min.js') }}"></script>


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
                "informe",
                "conclusion",
                "recomendacion",
                "fecha",
                "imagen_1",
                "imagen_2",
                "imagen_3",
                "examen_id",
            ],
            loadRelations: true,
            relations: [
                {
                    name: "examenes", 
                    nameSecondary: "examen", 
                    nameIndex: ["id"], 
                    selectId: "examen_id",
                }, 
            ],
            ImageContent: {
                loadImage: true,
                nameIndex: "image_index",
                namePreview: "image_preview",
                stylesImage: {
                    width: "100px",
                    height: "100px",
                    borderRadius: "10px",
                }
            },
            formatAction: formatAction,
            formatActionRestore: formatActionRestore,
        };

        const crudHandler = new CrudHandler(apiClient, "resultado", config);

        document.addEventListener("DOMContentLoaded", () => {
            crudHandler.init();
            $('.dropify').dropify();
        });

        function mostrarVistaPrevia() {
            const inputImagen = document.getElementById('imagen');
            const vistaPrevia = document.getElementById('vista-previa');

            const archivo = inputImagen.files[0];

            if (archivo) {
                const lector = new FileReader();

                lector.onload = function(e) {
                    vistaPrevia.src = e.target.result;
                    vistaPrevia.style.display = 'block';
                };

                lector.readAsDataURL(archivo);
            } else {
                vistaPrevia.style.display = 'none';
                vistaPrevia.src = '';  
            }
        }

        $("#save-custom").click(() => {
            crudHandler.postInsert();
            setTimeout(() => {
                window.location.href = URL_WEB + 'resultado'
            }, 1000);
        });


    </script>
@endsection
