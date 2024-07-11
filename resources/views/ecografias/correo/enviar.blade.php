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
                        <form action="{{ asset('/correo-enviar-mensaje') }}" method="get">
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
                                <input type="email" class="form-control" id="email_receptor" name="email_receptor"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="mensaje" class="form-label col-3">Mensaje:</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                            </div>

                            <button type="button" class="btn btn-primary" id="individual">Enviar indvidual</button>
                            <button type="button" class="btn btn-secondary" id="todos">Enviar Todos</button>
                            <button type="button" class="btn btn-success" id="resultados">Enviar Resultados</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('class/urlLocal.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const buttonIndividual = document.getElementById('individual');
            const buttonTodos = document.getElementById('todos');
            const buttonResultados = document.getElementById('resultados');
            const asunto = document.getElementById('asunto');
            const nombre = document.getElementById('nombre');
            const emailReceptor = document.getElementById('email_receptor');
            const mensaje = document.getElementById('mensaje');
           

            buttonIndividual.addEventListener('click', async () => {
                const params = {
                    asunto: asunto.value,
                    nombre: nombre.value,
                    email_receptor: emailReceptor.value,
                    mensaje: mensaje.value
                 };
                try {
                    const resultado = await enviarMensaje('correo-enviar-mensaje', params);
                    console.log(resultado);
                } catch (error) {
                    console.error('Error al enviar mensaje:', error);
                }
            });

            buttonTodos.addEventListener('click', async () => {
                const params = {
                    asunto: asunto.value,
                    nombre: nombre.value,
                    email_receptor: emailReceptor.value,
                    mensaje: mensaje.value
                 };
                try {
                    const resultado = await enviarMensaje('correo-enviar-mensaje-todos', params);
                    console.log(resultado);
                } catch (error) {
                    console.error('Error al enviar mensaje:', error);
                }
            });

            buttonResultados.addEventListener('click', async () => {
                const params = {
                    asunto: asunto.value,
                    nombre: nombre.value,
                    email_receptor: emailReceptor.value,
                    mensaje: mensaje.value
                 };
                try {
                    const resultado = await enviarMensaje('correo-enviar-mensaje-todos-resultados', params);
                    console.log(resultado);
                } catch (error) {
                    console.error('Error al enviar mensaje:', error);
                }
            });

        });

        async function enviarMensaje(endpoint, params) {
                const urlHttp = `${URL_WEB}${endpoint}?${new URLSearchParams(params).toString()}`;

                try {
                    const response = await fetch(urlHttp);

                    if (!response.ok) {
                        throw new Error('Error HTTP, estado = ' + response.status);
                    }

                    return response.json();
                } catch (error) {
                    console.error('Error al enviar mensaje:', error);
                    throw error;
                }
            }
    </script>
@endsection


