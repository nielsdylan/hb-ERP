@extends('components.layouts.app')
@section('titulo')
HB GROUP - Agregar Participantes
@endsection
@section('css')
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Agregar Participantes</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Academico</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Gestion de Aulas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Asistencia de alumnos</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $aula->codigo }}</h3>
                </div>
                <div class="card-body">
                    <form action="" id="guardar-alumno">
                        @csrf
                        <input type="hidden" name="aula_id" value="{{ $id }}">

                    </form>
                    <div class="row justify-content-md-center">
                        <div class="col-md-10">
                            <table class="table table-bordered text-nowrap border-bottom table-hover" id="tabla-data" width="100%">
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
                <div class="card-footer text-end">
                    <a href="{{ route('hb.academicos.aulas.lista') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-left"></i> Volver</a>
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
    {{-- <script src="{{asset('template/plugins/date-picker/date-picker.js')}}"></script>
    <script src="{{asset('template/plugins/date-picker/jquery-ui.js')}}"></script>
    <script src="{{asset('template/plugins/input-mask/jquery.maskedinput.js')}}"></script> --}}

    <!-- DATA TABLE JS-->
    <script src="{{asset('template/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/buttons.bootstrap5.min.js')}}"></script>

    <script src="{{asset('template/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('template/js/table-data.js')}}"></script>

    <script src="{{asset('components/academico/aulas/aula-model.js')}}"></script>
    <script src="{{asset('components/academico/aulas/aula-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            // $('.select2').select2();
            const view = new AulaView(new AulaModel(csrf_token));
            // view.alumnos();
            view.listarAsistenciaAlumnos();
        });



    </script>
@endsection
