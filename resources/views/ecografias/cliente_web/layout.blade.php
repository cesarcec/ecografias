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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
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
                @yield('container')
            </div>
        </div>
    </section>
    <!--/ banner-->
    

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
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
