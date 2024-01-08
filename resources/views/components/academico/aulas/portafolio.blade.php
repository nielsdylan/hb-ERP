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
                                                    <h3 class="h3 mb-2">{{ $aula->codigo }}</h3>
                                                    <h5 class="text-muted">{{ $aula->codigo }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-profile">
                                            <button class="btn btn-info mt-1 mb-1"> <i class="fe fe-cast"></i> <span>Ingresar al aula</span></button>
                                            {{-- <button class="btn btn-secondary mt-1 mb-1"> <i class="fa fa-envelope"></i> <span>Volver</span></button> --}}
                                            <a href="{{ route('hb.academicos.aulas.lista') }}" class="btn btn-danger mt-1 mb-1"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="px-0 px-sm-4">
                                        <div class="social social-profile-buttons mt-5 float-end">
                                            <div class="mt-3">
                                                <a class="social-icon text-primary" href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
                                                <a class="social-icon text-primary" href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                                                <a class="social-icon text-primary" href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a>
                                                <a class="social-icon text-primary" href="javascript:void(0)"><i class="fa fa-rss"></i></a>
                                                <a class="social-icon text-primary" href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
                                                <a class="social-icon text-primary" href="https://myaccount.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a>
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
                                    <li><a href="#agregar-alumnos" class="active" data-bs-toggle="tab">Agregar Alumnos</a></li>
                                    <li><a href="#asistencia-alumnos" data-bs-toggle="tab">Asistencia de Alumnos</a></li>
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
                                                            <select class="form-control select2" name="usuarios" data-placeholder="Seleccione a los alumnos.." required>
                                                                <option value="">Seleccione a los alumnos..</option>
                                                                @foreach ($alumnos as $value)
                                                                        <option value="{{ $value->usuario->id }}">
                                                                            {{ $value->usuario->nro_documento.' - '. $value->usuario->persona->apellido_paterno.' '.$value->usuario->persona->apellido_materno.' '.$value->usuario->persona->nombres }}
                                                                        </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="form-label">Maximo de alumnos</label>
                                                            <input type="text" value="{{ $aula->capacidad }}" class="form-control form-control-sm" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <table class="table table-bordered text-nowrap border-bottom table-hover" id="tabla-data-alumnos" width="100%">
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
                                            <table class="table table-bordered text-nowrap border-bottom table-hover" id="tabla-data-asistencia" width="100%">
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
                                    <p>over the years, sometimes by accident, sometimes on purpose (injected humour and the like</p>
                                </div>
                                <div class="tab-pane" id="tab8">
                                    <p>page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes
                                        by accident, sometimes on purpose (injected humour and the like</p>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- ROW-1 END -->


</div>
@endsection

@section('script')

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{asset('template/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('template/js/select2.js')}}"></script>

    <!-- DATEPICKER JS -->
    <script src="{{asset('template/plugins/date-picker/date-picker.js')}}"></script>
    <script src="{{asset('template/plugins/date-picker/jquery-ui.js')}}"></script>
    <script src="{{asset('template/plugins/input-mask/jquery.maskedinput.js')}}"></script>

    <!-- DATA TABLE JS-->
    <script src="{{asset('template/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/buttons.bootstrap5.min.js')}}"></script>

    <script src="{{asset('template/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('template/js/table-data.js')}}"></script>

    <script src="{{asset('components/academico/aulas/aula-model.js')}}"></script> {{-- estas son las rutas --}} 

    <script src="{{asset('components/academico/aulas/alumnos-view.js')}}"></script>
    <script src="{{asset('components/academico/aulas/asistencia-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            $('.select2').select2();
            const viewAlumnos = new AlumnosView(new AulaModel(csrf_token));
            viewAlumnos.alumnos();
            viewAlumnos.listarAlumno();

            const viewAsistencia = new AsistenciaView(new AulaModel(csrf_token));
            viewAsistencia.eventos();
            viewAsistencia.listar();
        });



    </script>
@endsection
