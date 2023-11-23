{{-- @extends('components.layouts.app') --}}
@extends('components.configuraciones.app-configuraciones')
@section('titulo')
HB GROUP - Gestion de Accesos
@endsection
@section('content')
@section('configuracion-page-header')

<div class="page-header">
    <h1 class="page-title">Gestion de Accesos</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Configuraciones</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestion de Accesos</li>
        </ol>
    </div>
</div>

@endsection
@section('configuracion-content')
<!-- ROW-1 -->
<div class="row">
    <div class="col-md-12">
        <form action="" id="guardar">
            <div class="card">
                {{-- <div class="card-status bg-blue br-te-7 br-ts-7"></div> --}}
                <div class="card-header">
                    <h3 class="card-title">Accesos</h3>
                    <div class="card-options">
                        <a href="{{ route('hb.configuraciones.usuarios.lista') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
                    <div class="row  pb-5">
                        <div class="col-md-4">
                            <div class="form-group select2-sm">
                                <label class="form-label"> Menus</label>
                                <select class="form-control select2 select2-show-search form-select menus-seleccionar" data-placeholder="Seleccione..." name="menu" required>
                                    <option label="Seleccione..."></option>
                                    @foreach ($menu_padres as $key=>$item)
                                        <option value="{{ $item->id }}">{{ $item->titulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group select2-sm">
                                <label class="form-label"> Sub Menus </label>
                                <select class="form-control select2 select2-show-search form-select menus-seleccionar" data-placeholder="Seleccione..." name="sub-menu" disabled>
                                    <option label="Seleccione..."></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-md-center"data-action="accesoss" id="opciones-accesos">

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- ROW-1 END -->

<!-- MODAL EFFECTS -->
<div class="modal fade effect-super-scaled " id="modal-usuario">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Nuevo Tipo de Documento</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="guardar" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="0">
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('script')

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{asset('template/plugins/select2/select2.full.min.js')}}"></script>
    {{-- <script src="{{asset('template/js/select2.js')}}"></script> --}}

    <!-- DATA TABLE JS-->
    {{-- <script src="{{asset('template/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/buttons.bootstrap5.min.js')}}"></script>

    <script src="{{asset('template/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('template/js/table-data.js')}}"></script> --}}

    <script src="{{asset('components/configuraciones/usuarios/usuario-model.js')}}"></script>
    <script src="{{asset('components/configuraciones/usuarios/accesos_usuarios-view.js')}}"></script>
    <script>
        // Select2
        $('.select2-show-search').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $(document).ready(function () {
            const view = new AccesosUsuariosView(new UsuarioModel(csrf_token));
            // view.listar();
            view.eventos();
        });




    </script>
@endsection
