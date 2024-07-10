@extends('ecografias.cliente_web.layout')

@section('container')   

    <div class="container detail-result">
        <h3 for="nombre">Detalle del resultado ecográfico</h3>
        <br>
        <div class="row" id="collapse-form">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="resultado_id">Nro de resultado</label>
                    <input id="resultado_id" class="form-control" type="text" value="{{$resultado->id}}" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label for="fecha">Fecha de resultado</label>
                    <input id="fecha" class="form-control" type="text" value="{{$resultado->fecha}}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="especialista">Especialista</label>
                    <input id="especialista" class="form-control" type="text" value="{{$resultado->examen->ordenExamen->doctor->user->name}}" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="paciente">Paciente</label>
                    <input id="paciente" class="form-control" type="text" value="{{$resultado->examen->ordenExamen->paciente->user->name}}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="informe">Informe ecográfico</label>
                    <textarea name="informe" id="informe" cols="30" rows="4" class="form-control" disabled>{{$resultado->informe}}  
                    </textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="conclusion">Conclusiones</label>
                    <textarea name="conclusion" id="conclusion" cols="30" rows="3" class="form-control" disabled>{{$resultado->conclusion}}
                    </textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="recomendacion">Recomendaciones</label>
                    <textarea name="recomendacion" id="recomendacion" cols="30" rows="3" class="form-control" disabled>{{$resultado->recomendacion}}</textarea>
                </div>
            </div>
            <div class="form-group col-md-12 ">
                <Label>Imágenes del examen ecográfico</Label>
                <div class="col-md-12 col-sm-12 img-container">
                    <div class="row">
                        <div class="img-content col-md-4">
                            <img class="img-resultado" src="{{asset('assets/img/resultado/' . $resultado->imagen_1)}}" alt="">
                        </div>
                        <div class="img-content col-md-4">
                            <img class="img-resultado" src="{{asset('assets/img/resultado/' . $resultado->imagen_2)}}" alt="">
                        </div>
                        <div class="img-content col-md-4">
                            <img class="img-resultado" src="{{asset('assets/img/resultado/' . $resultado->imagen_3)}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 form-group my-2 section-map">
        <div class="container-map-client">
            <h3 class="titulo_h3"><i class="fas fa-map-marker"></i>
                Tu dirección
            </h3>
            <input id="referencia" type="text" class="form-control" placeholder="Escribe tu dirección">
            <div class="col-12 form-group">
                <input class="d-none" type="hidden" name="" id="latitud">
                <input class="d-none" type="hidden" name="" id="longitud">
        
                <div id="map-container col-12">
                    <div id="map"></div>
                    {{-- <button id="ubicacion-actual-btn" type="button" title="Ubicación actual">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fa fa-map-marker"></i>
                        </div>
                    </button> --}}
                </div>
            </div>
        </div>
    </div>

    
    <div class="row container-button">
        <div class="form-group col-12">
            <button id="clear" class="btn btn-secondary my-2">Limpiar</button>
            <button id="save" class="btn btn-primary my-2">Guardar</button>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="{{ asset('plantilla/css/dropify/dropify.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        #map {
            width: 400px;
            height: 400px;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('class/urlLocal.js') }}"></script>
    <script src="{{ asset('class/apiClient.js') }}"></script>
    <script src="{{ asset('class/crudHandler.js') }}"></script>
    <script src="{{ asset('plantilla/js/dropify/dropify.min.js') }}"></script>
    <script> const pacienteId = {{Auth::user()->load('paciente')->paciente->id}}</script>

    // <script src="{{ asset('cliente_web/js/google.maps.js') }}"></script>
    {{-- <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjXj-GJgrK0IxxXbAooSzVli7husYOZIY&loading=async&libraries=geometry,places&callback=initMap">
    </script> --}}
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjXj-GJgrK0IxxXbAooSzVli7husYOZIY&callback=initMap">
    </script>
    <script src="{{ asset('cliente_web/js/confirmar.js') }}"></script>


@endsection