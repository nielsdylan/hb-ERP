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
                <li class="breadcrumb-item active" aria-current="page">{{ $tipo }}</li>
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
                    <h3 class="card-title">{{$tipo}}</h3>
                    {{-- <div class="card-options">
                        <a href="{{ route('hb.academicos.cuestionario.lista') }}" class="btn btn-success btn-sm ms-2" id="nuevo" ><i class="fe fe-plus"></i> Nuevo Cuestionario</a>

                    </div> --}}
                </div>
                <form action="">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input id="codigo" class="form-control form-control-sm" type="text" name="codigo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input id="nombre" class="form-control form-control-sm" type="text" name="nombre">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="preguntas"></div>
                            <div class="col-md-12" >
                                <button type="button" class="btn btn-success nueva-pregunta"><i class="fe fe-plus"></i> Nueva pregunta</button>
                            </div>
                        </div>
                    </div>
                </form>
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

    <!-- DATA TABLE JS-->
    {{-- <script src="{{asset('template/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/buttons.bootstrap5.min.js')}}"></script>

    <script src="{{asset('template/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('template/js/table-data.js')}}"></script> --}}

    <script src="{{asset('components/academico/cuestionarios/cuestionario-model.js')}}"></script>
    <script src="{{asset('components/academico/cuestionarios/cuestionario-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new CuestionarioView(new CuestionarioModel(csrf_token));
            view.eventos();
            view.cuestionario();
        });



    </script>
@endsection
