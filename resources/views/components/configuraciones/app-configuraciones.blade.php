@extends('components.layouts.app')
@section('titulo')
HB GROUP - Configuraciones
@endsection
@section('css')
    @yield('configuracion-css')
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    
    @yield('configuracion-page-header')
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="list-group list-group-transparent mb-0 file-manager file-manager-border">
                        <h4>General</h4>
                        <div>
                            <a href="{{ route('hb.configuraciones.usuarios.lista') }}" class="list-group-item  d-flex align-items-center px-0 border-top">
                                <i class="fe fe-user fs-18 me-2 text-success p-2"></i>Usuarios
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('hb.configuraciones.tipo-documentos.lista') }}" class="list-group-item  d-flex align-items-center px-0">
                                <i class="fe fe-file fs-18 me-2 text-secondary p-2"></i>Tipo de Documentos
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('hb.configuraciones.tipo-monedas.lista') }}" class="list-group-item  d-flex align-items-center px-0">
                                <i class="fe fe-dollar-sign fs-18 me-2 text-primary p-2"></i> Tipo de Monedas
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('hb.configuraciones.accesos.lista') }}" class="list-group-item  d-flex align-items-center px-0">
                                <i class="fa fa-street-view fs-18 me-2 text-warning p-2"></i> Accesos
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('hb.configuraciones.log-actividades.lista') }}" class="list-group-item  d-flex align-items-center px-0">
                                <i class="fe fe-eye fs-18 me-2 text-danger p-2"></i> Log de Actividades
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @yield('configuracion-content')
        </div>
    </div>
</div>
@endsection
@section('script')
    @yield('configuracion-script')
@endsection