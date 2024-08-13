<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CEDISA</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('plantilla/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/custom.style.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('plantilla/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    @yield('css')

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">CEDISA - Centro de imagenologia </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

            {{-- Usuarios --}}
            @php
                $user = Auth::user();  
                $user->load('rol'); 
            @endphp
            
            @php
                if ($user->rol->nombre == 'Administrador') {
            @endphp

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                    aria-expanded="true" aria-controls="collapseUsers">
                    <i class="bi bi-person-badge"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Registra Usuarios:</h6>
                        <a class="collapse-item" href="{{ url('/doctor') }}">Especialistas</a>
                        <a class="collapse-item" href="{{ url('/paciente') }}">Pacientes</a>
                        <a class="collapse-item" href="{{ url('/recepcionista') }}">Recepcionistas</a>
                        <a class="collapse-item" href="{{ url('/repartidor') }}">Repartidores</a>
                    </div>
                    
                </div>
                
            </li>

            @php
                }   

                if ( $user->rol->nombre == 'Recepcionista' ) {    
            @endphp
            

           

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
                    aria-expanded="true" aria-controls="collapseUsers">
                    <i class="bi bi-person-badge"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseUsers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Registra Usuarios:</h6>
                        <a class="collapse-item" href="{{ url('/paciente') }}">Pacientes</a>
                       
                    </div>
                </div>
            </li>

            @php
                }   

                if ($user->rol->nombre == 'Recepcionista' ) {    
            @endphp
           

                    
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudy"
                    aria-expanded="true" aria-controls="collapseStudy">
                   <i class="bi bi-lungs-fill"></i>
                    <span>Estudios</span>
                </a>
                <div id="collapseStudy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menú de estudios:</h6>
                        <a class="collapse-item" href="{{ url('/sala') }}">Salas</a>
                        <a class="collapse-item" href="{{ url('/tipo_estudio') }}">Tipo de estudios</a>
                        <a class="collapse-item" href="{{ url('/estudio') }}">Estudios</a>
                    </div>
                </div>
            </li>

            @php
                }   
                if ($user->rol->nombre == 'Administrador' ) {    
            @endphp
           

                    
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudy"
                    aria-expanded="true" aria-controls="collapseStudy">
                   <i class="bi bi-lungs-fill"></i>
                    <span>Estudios</span>
                </a>
                <div id="collapseStudy" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menú de estudios:</h6>
                        <a class="collapse-item" href="{{ url('/sala') }}">Salas</a>
                        <a class="collapse-item" href="{{ url('/tipo_estudio') }}">Tipo de estudios</a>
                        <a class="collapse-item" href="{{ url('/estudio') }}">Estudios</a>
                    </div>
                </div>
            </li>

            @php
                }

                if ($user->rol->nombre == 'Administrador' || $user->rol->nombre == 'Recepcionista' ) {    
            @endphp

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrden"
                    aria-expanded="true" aria-controls="collapseOrden">
                    <i class="bi bi-clipboard2-pulse-fill"></i>
                    <span>Órdenes de examen</span>
                </a>
                <div id="collapseOrden" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menú de órdenes:</h6>
                        <a class="collapse-item" href="{{ url('/orden') }}">Órdenes de examen</a>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExamen"
                    aria-expanded="true" aria-controls="collapseExamen">
                   <i class="bi bi-lungs-fill"></i>
                    <span>Exámenes</span>
                </a>
                <div id="collapseExamen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menú de Exámenes:</h6>
                        <a class="collapse-item" href="{{ url('/examen') }}">Examen</a>
                        <a class="collapse-item" href="{{ url('/resultado') }}">Resultados</a>
                    </div>
                </div>
                    </div>
                </div>
            </li>
            @php
                }

                if ($user->rol->nombre == 'Administrador' || $user->rol->nombre == 'Recepcionista' || $user->rol->nombre == 'Doctor') { 
            @endphp

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExamen"
                    aria-expanded="true" aria-controls="collapseExamen">
                    <i class="fa fa-braille" aria-hidden="true"></i>
                    <span>Exámenes</span>
                </a>
                <div id="collapseExamen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menú de Exámenes:</h6>
                        <a class="collapse-item" href="{{ url('/examen') }}">Examen</a>
                        <a class="collapse-item" href="{{ url('/resultado') }}">Resultados</a>
                    </div>
                </div>
            </li>
            
            @php
                }   

                if ( $user->rol->nombre == 'Administrador' || $user->rol->nombre == 'Recepcionista' || $user->rol->nombre == 'Repartidor' ) {    
            @endphp

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEnvio"
                    aria-expanded="true" aria-controls="collapseEnvio">
                    <i class="fa fa-motorcycle" aria-hidden="true"></i>

                    <span>Envíos</span>
                </a>
                <div id="collapseEnvio" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menú de Exámenes:</h6>
                        <a class="collapse-item" href="{{ url('/envio-resultado/pendiente') }}">Pendientes</a>
                        <a class="collapse-item" href="{{ url('/envio-resultado/asignado') }}">Aceptados</a>
                        <a class="collapse-item" href="{{ url('/envio-resultado/entregados') }}">Entregados</a>
                        <a class="collapse-item" href="{{ url('/envio-resultado/rechazados') }}">Rechazados</a>

                    </div>
                </div>
            </li>

            @php
                }
                if ( $user->rol->nombre == 'Administrador' || $user->rol->nombre == 'Recepcionista' || $user->rol->nombre == 'Repartidor' || $user->rol->nombre == 'Doctor' ) {    
            @endphp

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemail"
                    aria-expanded="true" aria-controls="collapseEnvio">
                    <i class="bi bi-envelope-at"></i>
                    <span>Envio de Mensajes</span>
                </a>
                <div id="collapsemail" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('/correo-enviar') }}">ENVIA TU MENSAJE AQUI! </a>

                    </div>
                </div>
            </li>
            @php
        }
            @endphp

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="container mt-3">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <span class="navbar-text">
                        Bienvenido a Cedisa
                    </span>
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout')}}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                @yield('contenido')
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->

    <script src="{{asset('plantilla/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('plantilla/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('plantilla/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    {{-- <script src="{{asset('plantilla/vendor/chart.js/Chart.min.js')}}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{asset('plantilla/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('plantilla/js/demo/chart-pie-demo.js')}}"></script> --}}

    @yield('js');

</body>

</html>
