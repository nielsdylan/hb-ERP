@extends('components.layouts.app')
@section('titulo')
HB GROUP - Cuestionario
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Cuestionario</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Mis cursos</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Cursos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cuestionario</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- ROW-1 -->
    <div class="row justify-content-md-center {{ ($cuestionario_usuario?'': 'd-none' ) }}" id="reporte-notas">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class=""><span class="text-success"><i class="fe fe-award mx-2 fs-20 text-success-shadow"></i></span>Resultados del Cuestionario</h6>
                    {{-- <h3 class="text-dark counter mt-0 mb-3 number-font">7,896</h3>
                    <div class="progress h-1 mt-0 mb-2">
                        <div class="progress-bar progress-bar-striped bg-primary" style="width: 70%;" role="progressbar"></div>
                    </div> --}}
                    <div class="row mt-4">
                        <div class="col text-center"> <span class="text-muted">Preguntas</span>
                            <h4 class="fw-normal mt-2 mb-0 number-font1" id="cantidad-preguntas">{{ ($cuestionario_usuario ? $numero_preguntas : '00' ) }}</h4>
                        </div>
                        <div class="col text-center"> <span class="text-muted">Aciertos</span>
                            <h4 class="fw-normal mt-2 mb-0 number-font2" id="aciertos">{{ ($cuestionario_usuario ? $cuestionario_usuario->aciertos : '00' ) }}</h4>
                        </div>
                        <div class="col text-center"> <span class="text-muted">Nota</span>
                            <h4 class="fw-normal mt-2 mb-0 number-font3" id="notas">{{ ($cuestionario_usuario ? $cuestionario_usuario->nota : '00' ) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row {{ ($cuestionario_usuario?'d-none': '' ) }}" id="car-cuestionario">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="" id="guardar">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2>{{$cuestionario->titulo}}</h2>
                                <input type="hidden" name="cuestionario_id" value="{{$cuestionario->id}}">
                                <input type="hidden" name="aula_id" value="{{$aula_id}}">
                            </div>
                        </div>
                        <div id="preguntas">
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fe fe-save"></i> Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <!-- ROW-1 END -->

</div>
@endsection
@section('script')
    <script src="{{ asset('components/mis-cursos/cuestionario-view.js') }}"></script>
    <script src="{{ asset('components/mis-cursos/mi-curso-model.js') }}"></script>
    <script>
        const view = new CuestionarioView(new MiCursoModel(csrf_token));
        view.cuestionario();
        view.eventos();
    </script>
@endsection
