@extends('components.layouts.app')
@section('titulo')
HB GROUP - Gestion de Cuestionario
@endsection
@section('css')
<style>
</style>
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Gestion de Cuestionario</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Academico</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Gestion de Cuestionario</a></li>
                <li class="breadcrumb-item active" aria-current="page">Resultados</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-status bg-blue br-te-7 br-ts-7"></div> --}}
                <div class="card-header">
                    <h3 class="card-title">Resultados</h3>
                    {{-- <div class="card-options">
                        <a href="{{ route('hb.academicos.cuestionario.lista') }}" class="btn btn-success btn-sm ms-2" id="nuevo" ><i class="fe fe-plus"></i> Nuevo Cuestionario</a>

                    </div> --}}
                </div>
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="card-body">

                    <div class="row justify-content-md-center">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom table-hover" id="tabla-data" width="100%">
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
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success btn-sm" ><i class="fe fe-save"></i> Guardar</button>
                    <a href="{{ route('hb.academicos.cuestionario.lista') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ROW-1 END -->

    <!-- MODAL ver  -->
    <div class="modal fade effect-super-scaled " id="modal-ver-respuestas">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">
                        <i class="fa fa-search"></i>
                    </h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">
                        &times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-md-center">
                        <div class="col-md-8">
                            <div id="preguntas"></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    {{-- <button type="submit" class="btn btn-success btn-sm"><i class="fe fe-save fe-spin"></i> Guardar</button> --}}
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"><i class="fe fe-x"></i> Cerrar</button>
                </div>
            </div>
        </div>
    </div>
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

    <script src="{{asset('components/academico/cuestionarios/cuestionario-model.js')}}"></script>
    <script src="{{asset('components/academico/cuestionarios/resultados-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new ResultadosView(new CuestionarioModel(csrf_token));
            view.listar();
            view.eventos();
        });



    </script>
@endsection
