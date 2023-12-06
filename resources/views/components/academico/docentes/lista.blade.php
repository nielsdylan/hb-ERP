@extends('components.layouts.app')
@section('titulo')
HB GROUP - Gestion de Docentes
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Gestion de Docentes</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Academico</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gestion de Docentes</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    @if (in_array(8,$array_accesos))
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-status bg-blue br-te-7 br-ts-7"></div> --}}
                <div class="card-header">
                    <h3 class="card-title">Lista de Docentes</h3>
                    <div class="card-options">
                        @if (in_array(9,$array_accesos))
                        <a href="javascript:void(0)" class="btn btn-success btn-sm ms-2" id="nuevo" ><i class="fe fe-plus"></i> Nuevo Docente</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-md-center">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom table-hover " id="tabla-data" width="100%">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">N° Documento</th>
                                        <th class="wd-15p border-bottom-0">Apellidos yNombres</th>
                                        <th class="wd-20p border-bottom-0">Correo Electronico</th>
                                        <th class="wd-20p border-bottom-0">Cargo</th>
                                        <th class="wd-20p border-bottom-0">Telefono</th>
                                        <th class="wd-20p border-bottom-0">Sexo</th>
                                        <th class="wd-20p border-bottom-0">Fecha Registro</th>
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
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <span class="alert-inner--icon"><i class="fe fe-bell"></i></span>
                    <span class="alert-inner--text"><strong>Información!</strong> Solicite los accesos al administrador</span>
                </div>
            </div>
        </div>
    @endif
    <!-- ROW-1 END -->


</div>
@endsection
@section('script')

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{asset('template/plugins/select2/select2.full.min.js')}}"></script>
    {{-- <script src="{{asset('template/js/select2.js')}}"></script> --}}

    <!-- DATA TABLE JS-->
    <script src="{{asset('template/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/buttons.bootstrap5.min.js')}}"></script>

    <script src="{{asset('template/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('template/js/table-data.js')}}"></script>

    <script src="{{asset('components/academico/docentes/docente-model.js')}}"></script>
    <script src="{{asset('components/academico/docentes/docente-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new DocenteView(new DocenteModel(csrf_token));
            view.listar();
            view.eventos();
        });



    </script>
@endsection
