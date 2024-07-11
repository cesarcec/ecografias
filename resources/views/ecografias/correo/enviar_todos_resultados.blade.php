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
                    <h3>Enviar todos los resultados</h3>
                </div>
                <div class="card-body">
                        <form action="{{asset('/correo-enviar-mensaje-todos-resultados')}}" method="get">
                            @csrf 
                            <div class="form-group d-flex justify-content-center align-items-center">
                                <label for="asunto" class="form-label col-3">Asunto:</label>
                                <input type="text" class="form-control" id="asunto" name="asunto" required>
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
