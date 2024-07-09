<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medilab Free Bootstrap HTML5 Template</title>
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords"
        content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
    <link rel="stylesheet" type="text/css" href="{{ asset('cliente_web/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('cliente_web/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('cliente_web/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('cliente_web/css/style.custom.css') }}">
    <!-- =======================================================
    Theme Name: Medilab
    Theme URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <!--banner-->
    <section id="banner" class="banner">
        <div class="bg-color">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="col-md-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"><img src="{{asset('assets/img/cedisa_logo_final-01.svg')}}" class="img-responsive"
                                    style="width: 140px; margin-top: -16px;"></a>
                        </div>
                        <div class="collapse navbar-collapse navbar-right" id="myNavbar">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#banner">Inicio</a></li>
                                <li class=""><a href="#service">Servicios</a></li>
                                <li class=""><a href="#about">Acerca de</a></li>
                                <li class=""><a href="#testimonial">Testimonios</a></li>
                                <li class="">
                                    @php
                                        if (Auth::user()) {
                                    @endphp
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fa fa-user" aria-hidden="true"></i> 
                                                {{Auth::user()->name}}
                                                <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="#">Mis citas</a></li>
                                                    <li><a href="#">Mis resultados</a></li>
                                                    <li><a href="{{ route('logout')}}">Cerrar sesión</a></li>
                                                    <li role="separator" class="divider"></li>
                                                </ul>
                                            </div>
                                      @php
                                        } else {
                                            echo '<li class=""><a href="#contact">Crear cuenta</a></li>';
                                        }
                                      @endphp
                                      
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="banner-info">
                        <div class="banner-logo text-center">
                            <img src="{{ asset('assets/img/cedisa_logo_final-01.svg') }}" class="img-responsive logo">
                        </div>
                        <div class="banner-text text-center">
                            <h1 class="white">CITA MÉDICA EN TU ESCRITORIO!!</h1>
                            <p class="medical-appointment-text">Recuerde siempre llevar consigo cualquier documentación
                                médica relevante. Su bienestar es nuestra prioridad</p>
                            <a href="#contact" class="btn btn-appoint">Haga una cita</a>
                        </div>
                        <div class="overlay-detail text-center">
                            <a href="#service"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ banner-->
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
                            <div class="more-features-box-text-icon"> <i class="fa fa-angle-right"
                                    aria-hidden="true"></i> </div>
                            <div class="more-features-box-text-description">
                                <h3>Información Importante para Ti</h3>
                                <p>Nos esforzamos por ofrecerte lo mejor en atención médica, garantizando que cada
                                    visita sea una experiencia positiva y enriquecedora.</p>
                            </div>
                        </div>
                        <div class="more-features-box-text">
                            <div class="more-features-box-text-icon"> <i class="fa fa-angle-right"
                                    aria-hidden="true"></i> </div>
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

    <!--testimonial-->
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


    <!--contact-->
    <!--contacto-->
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
                    <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>321 Calle Asombrosa<br> Nueva York, NY
                        17022</p>
                    <div class="space"></div>
                    <p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>info@nombrecompania.com</p>
                    <div class="space"></div>
                    <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>+1 800 123 1234</p>
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
                                <input type="text" name="nombre" class="form-control br-radius-zero"
                                    id="nombre" placeholder="Tu Nombre" data-rule="minlen:4"
                                    data-msg="Por favor ingresa al menos 4 caracteres" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group">
                              <label for="nombre">Apellido</label>
                              <input type="text" name="paterno" class="form-control br-radius-zero"
                                  id="paterno" placeholder="Tu Apellido" data-rule="minlen:4"
                                  data-msg="Por favor ingresa al menos 4 caracteres" />
                              <div class="validation"></div>
                            </div>
                            <div class="form-group">
                              <label for="nombre">Fecha de nacimiento</label>
                              <input type="date" name="fecha_nacimiento" class="form-control br-radius-zero"
                                  id="fecha_nacimiento" placeholder="Fecha de nacimiento"/>
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
                              <input class="form-control br-radius-zero" name="password"
                                    id="password" placeholder="Tu Contraseña" data-rule="minlen:4"
                                    data-msg="Por favor ingresa al menos 8 caracteres de contraseña" type="password"/>
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

    <!--/ contact-->

    <!--footer-->
    <footer id="footer">
        <div class="top-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 marb20">
                        <div class="ftr-tle">
                            <h4 class="white no-padding">Sobre Nosotros</h4>
                        </div>
                        <div class="info-sec">
                            <p>Somos una clínica comprometida con ofrecer atención médica de calidad, cuidando siempre
                                el bienestar de nuestros pacientes.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 marb20">
                        <div class="ftr-tle">
                            <h4 class="white no-padding">Enlaces Rápidos</h4>
                        </div>
                        <div class="info-sec">
                            <ul class="quick-info">
                                <li><a href="index.html"><i class="fa fa-circle"></i>Inicio</a></li>
                                <li><a href="#service"><i class="fa fa-circle"></i>Servicios</a></li>
                                <li><a href="#contact"><i class="fa fa-circle"></i>Contáctanos</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 marb20">
                        <div class="ftr-tle">
                            <h4 class="white no-padding">Síguenos</h4>
                        </div>
                        <div class="info-sec">
                            <ul class="social-icon">
                                <li class="bglight-blue"><i class="fa fa-facebook"></i></li>
                                <li class="bgred"><i class="fa fa-google-plus"></i></li>
                                <li class="bgdark-blue"><i class="fa fa-linkedin"></i></li>
                                <li class="bglight-blue"><i class="fa fa-twitter"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-line">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        © Derechos de Autor Tema Cedisa. Todos los derechos reservados
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--/ footer-->

    <script src="{{ asset('cliente_web/js/jquery.min.js') }}"></script>
    <script src="{{ asset('cliente_web/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('cliente_web/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('cliente_web/js/custom.js') }}"></script>
    <script src="{{ asset('cliente_web/contactform/contactform.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('class/urlLocal.js') }}"></script>
    <script src="{{ asset('class/apiCLient.js') }}"></script>
    <script src="{{ asset('class/crudHandler.js') }}"></script>


    <script>
        const formatAction = (element) => {
            return `
            <button data-id="${element.id}" class="btn btn-sm btn-warning edit"><i class="bi bi-pencil-fill"></i> Editar</button>
            <button data-id="${element.id}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i> Eliminar</button>`;
        };

        const formatActionRestore = (element) => {
            return `
            <button data-id="${element.id}" class="btn btn-sm btn-info restore"><i class="fa fa-undo"></i>Restaurar</button>`;
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

    

</body>

</html>
