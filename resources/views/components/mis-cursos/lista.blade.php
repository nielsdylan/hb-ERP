@extends('components.layouts.app')
@section('titulo')
HB GROUP - Mis Cursos
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Mis Cursos</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Mis Cursos</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    <div class="row">
        @foreach ( $aulas as $key => $value )
            <div class="col-md-4">
                <div class="card">
                    <a href="{{ route('hb.mis-cursos.curso', ['codigo'=>$value->codigo]) }}"><img class="card-img-top" src="{{ asset('components/images/cursos/mis-cursos.jpg') }}" alt="And this isn&#39;t my nose. This is a false one."></a>
                    <div class="card-body d-flex flex-column">
                        <h3>
                            <a href="{{ route('hb.mis-cursos.curso', ['codigo'=>$value->codigo]) }}">{{$value->curso->nombre}}</a>
                        </h3>
                        <div class="text-muted">
                            {{$value->codigo}}
                            <small class="d-block text-muted"> Fecha: {{ date("d/m/Y", strtotime($value->fecha)) }}</small>
                            <small class="d-block text-muted">H. Inicio: {{$value->hora_inicio }}</small>
                            <small class="d-block text-muted">H. Final: {{$value->hora_final }}</small>
                        </div>
                        <div class="d-flex align-items-center pt-5 mt-auto">
                            <span class="avatar avatar-md brround bg-success me-3">{{$value->usuario->avatar_initials}}</span>
                            <div>
                                <small class="d-block text-muted"> Docente:</small>
                                <a href="javascript:void(0)" class="text-default">{{$value->usuario->nombre_corto}}</a>
                            </div>
                            <div class="ms-auto">
                                <a href="javascript:void(0)" class="icon d-none d-md-inline-block text-muted"><i class="fe fe-cast border brround"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
    <!-- ROW-1 END -->
    <div class="row justify-content-md-center">
        <div class="col-md-2">
            {{ $aulas->links() }}
        </div>
    </div>

</div>
@endsection
