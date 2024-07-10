@extends('ecografias.cliente_web.layout')

@section('container')
    <!--service-->
    <section id="service" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <h2 class="ser-title">Nuestros Servicios</h2>
                    <hr class="botm-line">
                    <p>Ofrecemos una variedad de servicios médicos para atender sus necesidades de salud. Nuestro equipo
                        de profesionales está dedicado a proporcionarle la mejor atención posible.</p>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="service-info">
                        <div class="icon">
                            <i class="fa fa-stethoscope"></i>
                        </div>
                        <div class="icon-info">
                            <h4>Soporte 24 Horas</h4>
                            <p>Estamos disponibles las 24 horas del día para brindarle el soporte médico que necesita en
                                cualquier momento.</p>
                        </div>
                    </div>
                    <div class="service-info">
                        <div class="icon">
                            <i class="fa fa-ambulance"></i>
                        </div>
                        <div class="icon-info">
                            <h4>Servicios de Emergencia</h4>
                            <p>Nuestro equipo de emergencia está preparado para atender cualquier situación crítica de
                                manera rápida y eficiente.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="service-info">
                        <div class="icon">
                            <i class="fa fa-user-md"></i>
                        </div>
                        <div class="icon-info">
                            <h4>Consejería Médica</h4>
                            <p>Ofrecemos sesiones de consejería médica para ayudarle a entender mejor su salud y tomar
                                decisiones informadas.</p>
                        </div>
                    </div>
                    <div class="service-info">
                        <div class="icon">
                            <i class="fa fa-medkit"></i>
                        </div>
                        <div class="icon-info">
                            <h4>Atención Médica Premium</h4>
                            <p>Proporcionamos atención médica de alta calidad para garantizar que reciba el mejor
                                tratamiento posible.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ service-->

    <!--cta-->
    <section id="cta-1" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="schedule-tab">
                    <div class="col-md-4 col-sm-4 bor-left">
                        <div class="mt-boxy-color"></div>
                        <div class="medi-info">
                            <h3>Casos de Emergencia</h3>
                            <p>Estamos aquí para ayudarte en situaciones críticas. Nuestro equipo está preparado para
                                atender emergencias médicas de manera rápida y eficaz.</p>
                            <a href="#" class="medi-info-btn">LEER MÁS</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="medi-info">
                            <h3>Atención de Emergencias</h3>
                            <p>Ofrecemos servicios de emergencia las 24 horas del día, los 7 días de la semana. Nuestro
                                objetivo es proporcionarte la mejor atención en los momentos que más lo necesitas.</p>
                            <a href="#" class="medi-info-btn">LEER MÁS</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 mt-boxy-3">
                        <div class="mt-boxy-color"></div>
                        <div class="time-info">
                            <h3>Horarios de Atención</h3>
                            <table class="horarios-atencion" style="margin: 8px 0px 0px;" border="1">
                                <tbody>
                                    <tr>
                                        <td>Lunes - Viernes</td>
                                        <td>8:00 - 17:00</td>
                                    </tr>
                                    <tr>
                                        <td>Sábado</td>
                                        <td>9:30 - 17:30</td>
                                    </tr>
                                    <tr>
                                        <td>Domingo</td>
                                        <td>9:30 - 15:00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--cta-->

    <!--about-->
    <section id="about" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="section-title">
                        <h2 class="head-title lg-line">El Sueño <br>Definitivo de Medilap</h2>
                        <hr class="botm-line">
                        <p class="sec-para">Nos dedicamos a proporcionar una atención médica de alta calidad,
                            innovadora y centrada en el paciente.</p>
                        <a href="#" style="color: #0cb8b6; padding-top:10px;">Saber más..</a>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div style="visibility: visible;" class="col-sm-9 more-features-box">
                        <div class="more-features-box-text">
                            <div class="more-features-box-text-icon"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </div>
                            <div class="more-features-box-text-description">
                                <h3>Información Importante para Ti</h3>
                                <p>Nos esforzamos por ofrecerte lo mejor en atención médica, garantizando que cada
                                    visita sea una experiencia positiva y enriquecedora.</p>
                            </div>
                        </div>
                        <div class="more-features-box-text">
                            <div class="more-features-box-text-icon"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </div>
                            <div class="more-features-box-text-description">
                                <h3>Información Importante para Ti</h3>
                                <p>Nuestro equipo de profesionales está aquí para ayudarte con cualquier necesidad
                                    médica que puedas tener, asegurando tu bienestar y satisfacción.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ about-->

    <!--testimonio-->
    <section id="testimonial" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="ser-title">¿Qué dicen nuestros pacientes?</h2>
                    <hr class="botm-line">
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="testi-details">
                        <!-- Paragraph -->
                        <p>La atención médica fue excelente. El equipo se aseguró de que me sintiera cómodo y bien
                            cuidado durante toda mi visita.</p>
                    </div>
                    <div class="testi-info">
                        <!-- User Image -->
                        <a href="#"><img src="img/thumb.png" alt="" class="img-responsive"></a>
                        <!-- User Name -->
                        <h3>Alex<span>Texas</span></h3>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="testi-details">
                        <!-- Paragraph -->
                        <p>Estoy muy agradecida por el servicio recibido. Los doctores son muy profesionales y el
                            personal muy amable.</p>
                    </div>
                    <div class="testi-info">
                        <!-- User Image -->
                        <a href="#"><img src="img/thumb.png" alt="" class="img-responsive"></a>
                        <!-- User Name -->
                        <h3>María<span>Lopez</span></h3>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="testi-details">
                        <!-- Paragraph -->
                        <p>Recomiendo esta clínica a todos. La calidad del servicio y la atención al detalle fueron
                            excepcionales.</p>
                    </div>
                    <div class="testi-info">
                        <!-- User Image -->
                        <a href="#"><img src="img/thumb.png" alt="" class="img-responsive"></a>
                        <!-- User Name -->
                        <h3>Juan<span>Pérez</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ testimonial-->

    <section id="contact" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="ser-title">Contáctanos</h2>
                        <hr class="botm-line">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <h3>Información de contacto</h3>
                        <div class="space"></div>
                        <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i># 435 calle Santa Barbara<br>Santa Cruz -
                            Centro</p>
                        <div class="space"></div>
                        <p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>admin@correo.cedisa.bo</p>
                        <div class="space"></div>
                        <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>+78505745</p>
                    </div>
                    <div class="col-md-8 col-sm-8 marb20">
                        <div class="contact-info">
                            <h3 class="cnt-ttl">¿Tienes alguna consulta? ¡Crea una cuenta para reservar una cita!</h3>
                            <div class="space"></div>
                            <div id="sendmessage">Tu mensaje ha sido enviado. ¡Gracias!</div>
                            <div id="errormessage"></div>
                            <form action="" method="post" role="form" class="contactForm">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" class="form-control br-radius-zero" id="nombre"
                                        placeholder="Tu Nombre" data-rule="minlen:4"
                                        data-msg="Por favor ingresa al menos 4 caracteres" />
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Paterno</label>
                                    <input type="text" name="paterno" class="form-control br-radius-zero" id="paterno"
                                        placeholder="Tu Apellido paterno" data-rule="minlen:4"
                                        data-msg="Por favor ingresa al menos 4 caracteres" />
                                    <div class="validation"></div>
                                    <div class="form-group">
                                        <label for="nombre">Materno</label>
                                        <input type="text" name="materno" class="form-control br-radius-zero"
                                            id="materno" placeholder="Tu Apellido materno" data-rule="minlen:4"
                                            data-msg="Por favor ingresa al menos 4 caracteres" />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Fecha de nacimiento</label>
                                        <input type="date" name="fecha_nacimiento" class="form-control br-radius-zero"
                                            id="fecha_nacimiento" placeholder="Fecha de nacimiento" />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Género</label>
                                        <select name="genero" id="genero" class="form-control">
                                            <option value="M">Hombre</option>
                                            <option value="F">Mujer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Correo</label>
                                        <input type="email" class="form-control br-radius-zero" name="email"
                                            id="email" placeholder="Tu Correo Electrónico" data-rule="email"
                                            data-msg="Por favor ingresa un correo electrónico válido" />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Contraseña</label>
                                        <input class="form-control br-radius-zero" name="password" id="password"
                                            placeholder="Tu Contraseña" data-rule="minlen:4"
                                            data-msg="Por favor ingresa al menos 8 caracteres de contraseña"
                                            type="password" />
                                        <div class="validation"></div>
                                    </div>

                                    <input type="hidden" value="Sin materno" id="materno">

                                    <div class="form-action">
                                        <button id="save" type="button" class="btn btn-form">Crear cuenta</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('css')
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('class/urlLocal.js') }}"></script>
    <script src="{{ asset('class/apiClient.js') }}"></script>
    <script src="{{ asset('class/crudHandler.js') }}"></script>


    <script>
        const formatAction = (element) => {
            return `
            <button data-id="${element.id}" class="btn btn-sm btn-warning edit"><i class="bi bi-pencil-fill"></i> Editar</button>
            <button data-id="${element.id}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i> Eliminar</button>`;
        };

        const formatActionRestore = (element) => {
            return `<button data-id="${element.id}" class="btn btn-sm btn-info restore"><i class="fa fa-undo"></i>Restaurar</button>`;
        };

        const apiClient = new ApiClient(URL_API_REST);
        const config = {
            // table: $("#table"),  
            // tableDeletes: $("#table-delete"),
            // loaderObject: loader,
            modalEdit: "modal_edit",
            // saveBtn: "save",
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
                "genero",
                "fecha_nacimiento",
                "email",
                "user_email",
                "password",
                "password_confirmation"
            ],
            loadRelations: true,
            relations: [{
                name: "user",
                nameSecondary: "user",
                nameIndex: ["email"],
                selectId: "user_id",
            }, ],
            formatAction: formatAction,
            formatActionRestore: formatActionRestore,
        };

        const crudHandler = new CrudHandler(apiClient, "paciente", config);

        document.addEventListener("DOMContentLoaded", () => {
            crudHandler.init();
        });

        $("#save").click(() => {
            if (!crudHandler.postInsert()) {
                return;
            }
            setTimeout(() => {
                crudHandler.showAlert('success', 'Ahora puedes iniciar sesión con tus credenciales', 2000);
                setTimeout(() => {
                    window.location.href = URL_WEB + "login";
                    //window.location.reload();
                }, 2000);
            }, 1600);
        });
    </script>
@endsection
