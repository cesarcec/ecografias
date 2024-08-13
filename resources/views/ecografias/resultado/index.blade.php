@extends('plantilla/layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="{{ asset('plantilla/css/dropify/dropify.min.css') }}">
@endsection


@section('contenido')
    {{-- <div class="card">
        <div class="card-header pointer-cursor" data-toggle="collapse" data-target="#collapse-form" aria-expanded="false"
            aria-controls="collapse-form">
            <div class="d-flex justify-content-between">
                <h3 class="my-2 mx-2">Resultados</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="collapse show" id="collapse-form">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="informe">Informe ecográfico</label>
                        <textarea name="informe" id="informe" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="conclusion">Conclusiones</label>
                        <textarea name="conclusion" id="conclusion" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="recomendacion">Recomendaciones</label>
                        <textarea name="recomendacion" id="recomendacion" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="examen_id">Nro de examen</label>
                        <input id="examen_id" class="form-control" value="123" type="text" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fecha">fecha</label>
                        <input id="fecha" class="form-control" value="" type="date"> 
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-12">Imagenes de la ecografía:</p>
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="form-group mt-2 mb-3 col-lg-4 col-md-12 col-sm-12">
                                <input type="file" id="image_1" name="image_1" class="dropify">
                                <small id="fileHelp" class="form-text text-muted">Inserta imágenes menores a 5 Megabytes</small>
                            </div>
                            <div class="form-group mt-2 mb-3 col-lg-4 col-md-6 col-sm-12">
                                <input type="file" id="image_2" class="dropify">
                                <small id="fileHelp" class="form-text text-muted">Inserta imágenes menores a 5 Megabytes</small>
                            </div>
                            <div class="form-group mt-2 mb-3 col-lg-4 col-md-6 col-sm-12">
                                <input type="file" id="image_3" class="dropify">
                                <small id="fileHelp" class="form-text text-muted">Inserta imágenes menores a 5 Megabytes</small>
                            </div>
                        </div>
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
    </div> --}}

    <section class="tablets mt-3">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#tab-index" data-toggle="tab"><i
                                class="bi bi-scissors"></i>&nbsp;&nbsp;Resultados</a>
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
                            <th data-field="examen_id">Nro de examen</th>
                            <th data-field="examen.orden_examen.paciente.user.name">Paciente</th>
                            <th data-field="examen.orden_examen.doctor.user.name">Doctor</th>
                            <th data-field="informe">Informe</th>
                            <th data-field="conclusion">Conclusiones</th>
                            <th data-field="recomendacion">Recomendaciones</th>
                            <th data-field="fecha">Fecha</th>
                            <th data-field="imagen_index">Imagen</th>
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
                            <th data-field="examen_id">Nro de examen</th>
                            <th data-field="examen.orden_examen.paciente.user.name">Paciente</th>
                            <th data-field="examen.orden_examen.doctor.user.name">Doctor</th>
                            <th data-field="informe">Informe</th>
                            <th data-field="conclusion">Conclusiones</th>
                            <th data-field="recomendacion">Recomendaciones</th>
                            <th data-field="fecha">Fecha</th>
                            <th data-field="imagen_index">Tipo de estudio</th>
                            <th data-field="action">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                            <label for="informe_edit">Informe ecográfico</label>
                            <textarea name="informe_edit" id="informe_edit" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="conclusion_edit">Conclusiones</label>
                            <textarea name="conclusion_edit" id="conclusion_edit" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="recomendacion_edit">Recomendaciones</label>
                            <textarea name="recomendacion_edit" id="recomendacion_edit" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="examen_id">Nro de examen</label>
                            <input id="examen_id" class="form-control" value="123" type="text" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imagen" accept="image/*" onchange="mostrarVistaPrevia()">
                                    <label class="custom-file-label" for="imagen">Seleccionar imagen</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <img id="vista-previa" src="#" alt="Vista previa de la imagen" style="max-width: 100%; max-height: 200px; display: none;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button id="clear" class="btn btn-secondary my-2">Limpiar</button>
                            <button id="save" class="btn btn-primary my-2">Guardar</button>
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
    <script src="{{ asset('plantilla/js/dropify/dropify.min.js') }}"></script>


    <script>
        const formatAction = (element) => {
            return `
            <button title="Editar" data-id="${element.id}" class="btn btn-sm btn-warning edit"><i class="bi bi-pencil-fill"></i></button>
            <button  title="Eliminar" data-id="${element.id}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button>
            <a href="${URL_WEB}resultado-comprobante/${element.id}" target="_blank" title="Comprobante resultado" data-id="${element.id}" class="btn btn-sm btn-primary note my-1"><i class="bi bi-file-earmark-pdf"></i></a>
            <a href="${URL_WEB}correo-enviar/" title="Enviar resultado por correo"  class="btn btn-sm btn-success note my-1"><i class="bi bi-send"></i></a>`;
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
                nameIndex: "imagen_index",
                namePreview: "imagen_preview",
                fieldName: 'imagen_1',
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

    </script>
@endsection
