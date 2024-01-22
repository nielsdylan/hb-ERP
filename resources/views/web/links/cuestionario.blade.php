
{{-- <body> --}}
@extends('web.layouts.app')
@section('title','Cuestionario')
@section('active_menu','active')
@section('content')
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="card">
                <form action="" id="guardar">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="hidden" name="cuestionario_codigo" value="{{ $cuestionario->codigo }}">
                    <input type="hidden" name="cuestionario_nombre" value="{{ $cuestionario->titulo }}">
                    <div class="card-body">
                        <h5 class="card-title">{{$cuestionario->nombre}}</h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="numero_documento">N° Documento</label>
                                    <input id="numero_documento" class="form-control form-control-sm" type="text" name="numero_documento" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apellido_paterno">Apellido Paterno</label>
                                    <input id="apellido_paterno" class="form-control form-control-sm" type="text" name="apellido_paterno" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apellido_materno">Apellido Materno</label>
                                    <input id="apellido_materno" class="form-control form-control-sm" type="text" name="apellido_materno">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nombre">Nombres</label>
                                    <input id="nombre" class="form-control form-control-sm" type="text" name="nombres" required>
                                </div>
                            </div>
                        </div>
                        <div id="preguntas"></div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-paper-plane"></i> Enviar cuestionario</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script src="{{asset('web/js/web-model.js')}}"></script>
<script src="{{asset('web/js/web-view.js')}}"></script>
<script>
    $(document).ready(function () {
            const view = new WebView(new WebModel(csrf_token));
            // view.listar();
            view.cuestionario();
        });
</script>
@endsection
