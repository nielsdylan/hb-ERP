@extends('components.configuraciones.app-configuraciones')
@section('titulo')
HB GROUP - Gestion de Actividades
@endsection
@section('content')
@section('configuracion-page-header')

<div class="page-header">
    <h1 class="page-title">Gestion de Actividades</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Configuraciones</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestion de Actividades</li>
        </ol>
    </div>
</div>

@endsection
@section('configuracion-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            {{-- <div class="card-status bg-blue br-te-7 br-ts-7"></div> --}}
            <div class="card-header">
                <h3 class="card-title">Lista de Actividades</h3>
                <div class="card-options">
                    {{-- <a href="javascript:void(0)" class="btn btn-success btn-sm" id="nuevo" ><i class="fe fe-plus"></i> Nuevo Accesos</a> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-md-center">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom table-hover" id="tabla-data" width="100%">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Fecha</th>
                                    <th class="wd-20p border-bottom-0">Usuario</th>
                                    <th class="wd-20p border-bottom-0">Tipo de Actividad</th>
                                    <th class="wd-20p border-bottom-0">Tabla</th>
                                    <th class="wd-15p border-bottom-0">-</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ROW-1 END -->

<!-- MODAL EFFECTS -->
<div class="modal fade effect-super-scaled " id="modal-actividades">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Nuevo Tipo de Documento</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="guardar" action="" method="POST">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Fecha :</label>
                                <input type="text" name="fecha" class="form-control form-control-sm"  disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Usuario :</label>
                                <input type="text" name="usuario" class="form-control form-control-sm"  disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Tipo de actividad :</label>
                                <input type="text" name="tipo_actividad" class="form-control form-control-sm"  disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Formulario :</label>
                                <input type="text" name="formulario" class="form-control form-control-sm"  disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Tabla :</label>
                                <input type="text" name="tabla" class="form-control form-control-sm"  disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs border rounded-top" id="myTab" role="tablist">
								<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tablehtml"
										role="tab" aria-selected="true" data-original-title="" title="">HTML</a></li>
							</ul>
							<div class="tab-content border border-top-0 p-0" id="myTabContent">
								<div class="tab-pane fade show active" id="tablehtml" role="tabpanel">
									<!-- Prism Code -->
									<figure class="highlight clip-widget mb-0">
										<pre class="language-css line-numbers language-markup ml-0 my-0 rounded-bottom">
                                            <code class="language-css language-markup">
                                                <script type="html-Sash/script">

                                                    <!-- app-Header -->
                                                    <div class="app-header header sticky">
                                                        <div class="container-fluid main-container">
                                                            <div class="d-flex">
                                                                <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
                                                                <!-- sidebar-toggle-->
                                                                <a class="logo-horizontal " href="index.html">
                                                                    <img src="../assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                                                                    <img src="../assets/images/brand/logo-3.png" class="header-brand-img light-logo1"
                                                                        alt="logo">
                                                                </a>
                                                                <!-- LOGO -->
                                                                <div class="main-header-center ms-3 d-none d-lg-block">
                                                                    <input type="text" class="form-control" id="typehead" placeholder="Search for results..." autocomplete="off">
                                                                    <button class="btn px-0 pt-2"><i class="fe fe-search" aria-hidden="true"></i></button>
                                                                </div>
                                                                <div class="d-flex order-lg-2 ms-auto header-right-icons">
                                                                    <div class="dropdown d-none">
                                                                        <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                                                            <i class="fe fe-search"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu header-search dropdown-menu-start">
                                                                            <div class="input-group w-100 p-2">
                                                                                <input type="text" class="form-control" placeholder="Search....">
                                                                                <div class="input-group-text btn btn-primary">
                                                                                    <i class="fe fe-search" aria-hidden="true"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- SEARCH -->
                                                                    ------------
                                                                    ------------
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /app-Header -->

                                                </script>
                                            </code>
                                        </pre>
									</figure>
									<!-- End Prism Precode -->

								</div>
							</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('script')

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{asset('template/plugins/select2/select2.full.min.js')}}"></script>
    {{-- <script src="{{asset('template/js/select2.js')}}"></script> --}}

    <script src="{{asset('template/js/menuspy.min.js.js')}} "></script>

    <!-- DATA TABLE JS-->
    <script src="{{asset('template/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/buttons.bootstrap5.min.js')}}"></script>

    <script src="{{asset('template/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('template/js/table-data.js')}}"></script>


    <script src="{{asset('components/configuraciones/log-activiades/log_actividades-model.js')}}"></script>
    <script src="{{asset('components/configuraciones/log-activiades/log_actividades-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new LogActividadView(new LogActividadModel(csrf_token));
            view.listar();
            view.eventos();
        });



    </script>
@endsection
