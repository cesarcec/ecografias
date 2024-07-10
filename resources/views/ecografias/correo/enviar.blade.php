@extends('plantilla/layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
@endsection


@section('contenido')
<div class="container mt-5">
    <div class="col-12 d-flex justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3>Enviar correo</h3>
                </div>
                <div class="card-body">
                        <form action="{{asset('/correo-enviar-mensaje')}}" method="get" id="correo">
                            @csrf 
                            <div class="form-group d-flex justify-content-center align-items-center">
                                <label for="asunto" class="form-label col-3">Asunto:</label>
                                <input type="text" class="form-control" id="asunto" name="asunto" required>
                            </div>
            
                            <div class="form-group d-flex justify-content-center align-items-center">
                                <label for="nombre" class="form-label col-3">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
            
                            <!-- <div class="form-group">
                                <label for="correo_remitente">Correo Remitente:</label>
                                <input type="email" class="form-control" id="email_remitent" name="correo_remitente" required>
                            </div> -->
            
                            <div class="form-group d-flex justify-content-center align-items-center">
                                <label for="email_receptor" class="form-label col-3">Correo Destinatario:</label>
                                <input type="email" class="form-control" id="email_receptor" name="email_receptor" required>
                            </div>
            
                            <div class="form-group">
                                <label for="mensaje" class="form-label col-3">Mensaje:</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                            </div>
            
                            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
        getMensaje();
    });

    function getMensaje(){
        let form = document.getElementById('correo');

        let formData = new FormData(form);


        $.ajax({
            url: "{{ url('correo-enviar-mensaje') }}/",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                if (response.codigo == 0) {
                    //successfull(response.mensaje);
                    Toast.fire({
                        icon: 'success',
                        title: response.mensaje,
                    });
                    $('#crearModalOficial').modal('hide');
                    location.reload();
                } else {
                    console.log(error);
                    //swalError(response.mensaje);
                    Toast.fire({
                        icon: 'error',
                        title: response.mensaje,
                    });
                }
            },
            error: function(error) {
                console.log(error);
                Toast.fire({
                    icon: 'error',
                    title: 'Ocurrió un error al guardar el ciudad',
                });
                //swalError('Ocurrió un error al guardar el ciudad');
            }
        });
    }
    </script>
@endsection