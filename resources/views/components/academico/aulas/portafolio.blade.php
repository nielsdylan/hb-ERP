@extends('components.layouts.app')
@section('titulo')
    HB GROUP - Alumnado
@endsection
@section('css')
@endsection
@section('content')
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Portafolio</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Academico</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Gestion de Aulas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Portafolio</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="wideget-user mb-2">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        <div class="panel profile-cover">
                                            <div class="profile-cover__action bg-img"></div>
                                            <div class="profile-cover__img">
                                                {{-- <div class="profile-img-1">
                                                <img src="../assets/images/users/21.jpg" alt="img">
                                            </div> --}}
                                                <div class="profile-img-content text-dark text-start">
                                                    <div class="text-dark">
                                                        <h3 class="h3 mb-2">{{ $aula->curso->nombre }}</h3>
                                                        <h5 class="text-muted">{{ $aula->codigo }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-profile">
                                                <button class="btn btn-info btn-sm mt-1 mb-1"> <i class="fe fe-cast"></i>
                                                    <span>Ingresar al aula</span></button>
                                                {{-- <button class="btn btn-secondary mt-1 mb-1"> <i class="fa fa-envelope"></i> <span>Volver</span></button> --}}
                                                <a href="{{ route('hb.academicos.aulas.lista') }}"
                                                    class="btn btn-danger btn-sm mt-1 mb-1"><i
                                                        class="fa fa-arrow-circle-left"></i> Volver</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="px-0 px-sm-4">
                                            <div class="social social-profile-buttons mt-5 float-end">
                                                <div class="mt-3">
                                                    <a class="social-icon text-primary" href="https://www.facebook.com/"
                                                        target="_blank"><i class="fa fa-facebook"></i></a>
                                                    <a class="social-icon text-primary" href="https://twitter.com/"
                                                        target="_blank"><i class="fa fa-twitter"></i></a>
                                                    <a class="social-icon text-primary" href="https://www.youtube.com/"
                                                        target="_blank"><i class="fa fa-youtube"></i></a>
                                                    <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                            class="fa fa-rss"></i></a>
                                                    <a class="social-icon text-primary" href="https://www.linkedin.com/"
                                                        target="_blank"><i class="fa fa-linkedin"></i></a>
                                                    <a class="social-icon text-primary" href="https://myaccount.google.com/"
                                                        target="_blank"><i class="fa fa-google-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" name="aula_id" value="{{ $aula->id }}">
                        <div class="panel panel-primary">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs">
                                        <li><a href="#agregar-alumnos" class="active" data-bs-toggle="tab">Agregar
                                                Alumnos</a></li>
                                        <li><a href="#asistencia-alumnos" data-bs-toggle="tab">Asistencia de Alumnos</a>
                                        </li>
                                        <li><a href="#examen" data-bs-toggle="tab">Examen</a></li>
                                        <li><a href="#tab8" data-bs-toggle="tab">Tab 4</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="agregar-alumnos">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="" id="guardar-alumno">
                                                    @csrf
                                                    <input type="hidden" name="aula_id" value="{{ $id }}">
                                                    <div class="row ">
                                                        <div class="col-md-4">
                                                            <div class="form-group select2-sm">
                                                                <label class="form-label">Usuarios</label>
                                                                <select class="form-control select2" name="usuarios"
                                                                    data-placeholder="Seleccione a los alumnos.." required>
                                                                    <option value="">Seleccione a los alumnos..
                                                                    </option>
                                                                    @foreach ($alumnos as $value)
                                                                        <option value="{{ $value->usuario->id }}">
                                                                            {{ $value->usuario->nro_documento . ' - ' . $value->usuario->persona->apellido_paterno . ' ' . $value->usuario->persona->apellido_materno . ' ' . $value->usuario->persona->nombres }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="form-label">Maximo de alumnos</label>
                                                                <input type="text" value="{{ $aula->capacidad }}"
                                                                    class="form-control form-control-sm" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-12">
                                                <table class="table table-bordered text-nowrap border-bottom table-hover"
                                                    id="tabla-data-alumnos" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th class="wd-15p border-bottom-0">#</th>
                                                            <th class="wd-15p border-bottom-0">N° DE DOCUMENTO</th>
                                                            <th class="wd-15p border-bottom-0">Apellidos y Nombres</th>
                                                            <th class="wd-20p border-bottom-0">Fecha Registro</th>
                                                            <th class="wd-20p border-bottom-0">Documento</th>
                                                            <th class="wd-20p border-bottom-0">Reservación</th>
                                                            <th class="wd-15p border-bottom-0">-</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="asistencia-alumnos">
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-12">
                                                <table class="table table-bordered text-nowrap border-bottom table-hover"
                                                    id="tabla-data-asistencia" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th class="wd-15p border-bottom-0">#</th>
                                                            <th class="wd-15p border-bottom-0">N° DE DOCUMENTO</th>
                                                            <th class="wd-15p border-bottom-0">Apellidos y Nombres</th>
                                                            <th class="wd-20p border-bottom-0">Fecha Registro</th>
                                                            <th class="wd-20p border-bottom-0">Asistencia</th>
                                                            <th class="wd-15p border-bottom-0">-</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="examen">
                                        <div class="row" id="cuestionarios-asignados">
                                            {{-- <div class="col-md-4">
                                                <div class="thumbnail text-center agregar-cuestionario" id="agregar-cuestionario">
                                                    <div class="caption">
                                                        <a href="javascript:void(0)">
                                                            <i class="fe fe-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="thumbnail">
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('images/examen/imagen_1.png') }}"
                                                            alt="thumb1" class="thumbimg">
                                                    </a>
                                                    <div class="caption">
                                                        <h4><strong>Thumbnail label</strong></h4>
                                                        <p>sed do eiusmod tempor incididunt ut labore et dolore magna
                                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                                            ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                        <p>
                                                            <a href="javascript:void(0)" class="btn btn-primary"
                                                                role="button">Resultado</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab8">
                                        <p>page editors now use Lorem Ipsum as their default model text, and a search for
                                            'lorem ipsum' will uncover many web sites still in their infancy. Various
                                            versions have evolved over the years, sometimes
                                            by accident, sometimes on purpose (injected humour and the like</p>
                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                                            tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                                            vero eos et</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- ROW-1 END -->
        <!-- MODAL EFFECTS -->
        <div class="modal fade effect-super-scaled " id="modal-cuestionario">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Lista de Cuestionarios</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered text-nowrap border-bottom table-hover"
                                    id="tabla-data-cuestionario" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">#</th>
                                            <th class="wd-15p border-bottom-0">Código</th>
                                            <th class="wd-15p border-bottom-0">Nombre</th>
                                            <th class="wd-20p border-bottom-0">Fecha de registro</th>
                                            <th class="wd-15p border-bottom-0">-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fe fe-save"></i> Guardar</button>
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"><i class="fe fe-x"></i> Cerrar</button>
                </div> --}}

                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <!-- INTERNAL SELECT2 JS -->
    <script src="{{ asset('template/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('template/js/select2.js') }}"></script>

    <!-- DATEPICKER JS -->
    <script src="{{ asset('template/plugins/date-picker/date-picker.js') }}"></script>
    <script src="{{ asset('template/plugins/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ asset('template/plugins/input-mask/jquery.maskedinput.js') }}"></script>

    <!-- DATA TABLE JS-->
    <script src="{{ asset('template/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('template/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('template/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('template/js/table-data.js') }}"></script>

    <script src="{{ asset('components/academico/aulas/aula-model.js') }}"></script> {{-- estas son las rutas --}}

    <script src="{{ asset('components/academico/aulas/alumnos-view.js') }}"></script>
    <script src="{{ asset('components/academico/aulas/asistencia-view.js') }}"></script>
    <script src="{{ asset('components/academico/aulas/examen-view.js') }}"></script>
    <script>
        // Select2

        $(document).ready(function() {
            $('.select2').select2();
            const viewAlumnos = new AlumnosView(new AulaModel(csrf_token));
            viewAlumnos.alumnos();
            viewAlumnos.listarAlumno();

            const viewAsistencia = new AsistenciaView(new AulaModel(csrf_token));
            viewAsistencia.eventos();
            viewAsistencia.listar();

            const viewExamen = new ExamenView(new AulaModel(csrf_token));
            viewExamen.eventos();
            viewExamen.listarCuestionario();
            viewExamen.examenes();
        });
    </script>
@endsection
