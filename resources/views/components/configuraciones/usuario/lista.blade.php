{{-- @extends('components.layouts.app') --}}
@extends('components.configuraciones.app-configuraciones')
@section('titulo')
HB GROUP - Gestion de Usuarios
@endsection
@section('content')
@section('configuracion-page-header')

<div class="page-header">
    <h1 class="page-title">Gestion de Usuarios</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Configuraciones</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestion de Usuarios</li>
        </ol>
    </div>
</div>

@endsection
@section('configuracion-content')
<!-- ROW-1 -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            {{-- <div class="card-status bg-blue br-te-7 br-ts-7"></div> --}}
            <div class="card-header">
                <h3 class="card-title">Lista de Usuarios</h3>
                <div class="card-options">
                    <a href="javascript:void(0)" class="btn btn-success btn-sm" id="nuevo" ><i class="fe fe-plus"></i> Nuevo Usuario</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-md-center">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom table-hover " id="tabla-data" width="100%">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Nombre corto</th>
                                    <th class="wd-15p border-bottom-0">Email</th>
                                    <th class="wd-20p border-bottom-0">Empresa</th>
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
<!-- ROW-1 END -->

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

    <script src="{{asset('components/configuraciones/usuarios/usuario-model.js')}}"></script>
    <script src="{{asset('components/configuraciones/usuarios/usuario-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new UsuarioView(new UsuarioModel(csrf_token));
            view.listar();
            view.eventos();
        });



    </script>
@endsection
