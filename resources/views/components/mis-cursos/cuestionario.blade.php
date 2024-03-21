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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="" id="guardar">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2>{{$cuestionario->titulo}}</h2>
                                <input type="hidden" name="cuestionario_id" value="{{$cuestionario->id}}">
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
