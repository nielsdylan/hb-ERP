<!doctype html>
<html lang="en" dir="ltr" >

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Software Academico">
    <meta name="author" content="Niels Dylan Quispe Peralta">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/hb_group.png') }}">
    <title> @yield('titulo')</title>
    <link id="style" href="{{ asset('template/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
     <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/plugins/protip/protip.min.css') }}">
    <link href="{{ asset('css/erp.css') }}" rel="stylesheet">

    <!-- INTERNAL Switcher css -->
    {{-- <link href="{{ asset('template/switcher/css/switcher.css') }}" rel="stylesheet">
    <link href="{{ asset('template/switcher/demo.css') }}" rel="stylesheet"> --}}
    @yield('css')

</head>

<body class="app sidebar-mini ltr light-mode">


    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <div class="spinner2 loader-img">
            <div class="cube1"></div>
            <div class="cube2"></div>
        </div>
        {{-- <img src="{{ asset('template/images/loader.svg') }}" class="loader-img" alt="Loader"> --}}
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            @include('components.layouts.app-header')
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            @include('components.layouts.app-sidebar')
            <!--/APP-SIDEBAR-->

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    @yield('content')
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->

        </div>

        <!-- Sidebar-right -->
        @include('components.layouts.sidebar-right')
        <!--/Sidebar-right-->

        <!-- Country-selector modal-->
        <div class="modal fade" id="country-selector">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content country-select-modal">
                    <div class="modal-header">
                        <h6 class="modal-title">Choose Country</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <ul class="row p-3">
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block active">
                                    <span class="country-selector"><img alt="" src="{{ asset('template/images/flags-img/us_flag.jpg') }}"
                                            class="me-3 language"></span>USA
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="{{ asset('template/images/flags-img/italy_flag.jpg') }}"
                                        class="me-3 language"></span>Italy
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="{{ asset('template/images/flags-img/spain_flag.jpg') }}"
                                        class="me-3 language"></span>Spain
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="{{ asset('template/images/flags-img/india_flag.jpg') }}"
                                        class="me-3 language"></span>India
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="{{ asset('template/images/flags-img/french_flag.jpg') }}"
                                        class="me-3 language"></span>French
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="{{ asset('template/images/flags-img/russia_flag.jpg') }}"
                                        class="me-3 language"></span>Russia
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="{{ asset('template/images/flags-img/germany_flag.jpg') }}"
                                        class="me-3 language"></span>Germany
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt=""
                                        src="{{ asset('template/images/flags-img/argentina.jpg') }}"
                                        class="me-3 language"></span>Argentina
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt="" src="{{ asset('template/images/flags-img/malaysia.jpg') }}"
                                        class="me-3 language"></span>Malaysia
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                                    <span class="country-selector"><img alt="" src="{{ asset('template/images/flags-img/turkey.jpg') }}"
                                        class="me-3 language"></span>Turkey
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Country-selector modal-->

        <!-- FOOTER -->
        @include('components.layouts.footer')
        <!-- FOOTER END -->

    <!-- MODAL EFFECTS -->
    <div class="modal fade effect-super-scaled " id="modal-cambio-clave">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Cambiar contraseña</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="cambiar-contraseña" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="0">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-label">Nueva contraseña : <span class="text-red">*</span></label>
                                    <input type="password" name="contrasena" class="form-control form-control-sm" placeholder="Contraseña..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-label">Repita la nueva contraseña : <span class="text-red">*</span></label>
                                    <input type="password" name="repetir_contrasena" class="form-control form-control-sm" placeholder="Contraseña..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fe fe-save"></i> Cambiar contraseña</button>
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"><i class="fe fe-x"></i> Cerrar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
    <script src="{{ asset('template/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('template/plugins/bootstrap5-typehead/autocomplete.js') }}"></script>
    <script src="{{ asset('template/js/typehead.js') }}"></script>
    {{-- <script src="{{ asset('template/plugins/notify/js/sample.js') }}"></script> --}}
    <script src="{{ asset('template/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ asset('template/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('template/plugins/p-scroll/pscroll.js') }}"></script>
    <script src="{{ asset('template/plugins/p-scroll/pscroll-1.js') }}"></script>
    <script src="{{ asset('template/plugins/sidemenu/sidemenu.js') }}"></script>
    <script src="{{ asset('template/plugins/sidebar/sidebar.js') }}"></script>
    <script src="{{ asset('template/js/themeColors.js') }}"></script>
    <script src="{{ asset('template/js/sticky.js') }}"></script>
    <script src="{{ asset('template/js/custom.js') }}"></script>
    <script src="{{ asset('template/plugins/protip/protip.min.js') }}"></script>
    <script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>


    <script src="{{ asset('components/app-model.js') }}"></script>
    <script src="{{ asset('components/app-view.js') }}"></script>
    @routes
    <script>
        const csrf_token = '{{ csrf_token() }}';
        const idioma = {
            "sProcessing":     '<i class="fa fa-spinner fa-spin"></i> Procesando...',
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate":
            {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria":
            {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        };
        $(document).ready(function () {
            $.protip();
            const view = new AppView(new AppModel(csrf_token));
            view.eventos();
        });

    </script>
    @yield('script')
</body>

</html>
