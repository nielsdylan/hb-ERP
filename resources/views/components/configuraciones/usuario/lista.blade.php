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
                    <div class="col-md-12">
                        <table class="table table-bordered text-nowrap border-bottom table-hover" id="tabla-data" width="100%">
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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group select2-sm">
                                <label class="form-label">Tipos de Documentos : <span class="text-red">*</span></label>
                                <select name="tipo_documento_id" class="form-control form-select form-select-sm select2" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($tipos_documentos as $key=>$item)
                                        <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">N° Documento : <span class="text-red">*</span></label>
                                <input type="text" name="nro_documento" class="form-control form-control-sm" placeholder="Número de documento..." data-search="numero_documento" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Apellido Paterno : <span class="text-red">*</span></label>
                                <input type="text" name="apellido_paterno" class="form-control form-control-sm" placeholder="Apellido Paterno..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Apellido Materno : <span class="text-red">*</span></label>
                                <input type="text" name="apellido_materno" class="form-control form-control-sm" placeholder="Apellido Materno..." required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Nombres : <span class="text-red">*</span></label>
                                <input type="text" name="nombres" class="form-control form-control-sm" placeholder="Nombres..." required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Whatsapp : </label>
                                <input type="number" name="whatsapp" class="form-control form-control-sm" placeholder="Whatsapp...">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Nacionalidad : </label>
                                <input type="text" name="nacionalidad" class="form-control form-control-sm" placeholder="Nacionalidad...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Cargo : </label>
                                <input type="text" name="cargo" class="form-control form-control-sm" placeholder="Cargo...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Telefono : </label>
                                <input type="number" name="telefono" class="form-control form-control-sm" placeholder="Telefono...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group select2-sm">
                                <label class="form-label">Sexo : <span class="text-red">*</span></label>
                                <select name="sexo" class="form-control form-select form-select-sm select2" required>
                                    <option value="">Seleccione...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group select2-sm">
                                <label class="form-label">Empresa : <span class="text-red">*</span></label>
                                <select name="empresa_id" class="form-control form-select form-select-sm select2" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($empresas as $key=>$item)
                                        <option value="{{ $item->id }}">{{ $item->razon_social }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Imagen de DNI : <span class="text-red">*</span></label>
                                <input type="file" name="path_dni" class="form-control form-control-sm" placeholder="path_dni..." accept=".jpg,.png" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Fecha de Cumpleaños : <span class="text-red">*</span></label>
                                <input type="date" name="fecha_cumpleaños" class="form-control form-control-sm text-center"  required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Fecha de Caducidad de DNI : <span class="text-red">*</span></label>
                                <input type="date" name="fecha_caducidad_dni" class="form-control form-control-sm text-center"  required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Email : <span class="text-red">*</span></label>
                                <input type="email" name="email" class="form-control form-control-sm text-center" placeholder="email@hotmail.com..."  required>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group select2-sm">
                                <label class="form-label">Roles : <span class="text-red">*</span></label>
                                <select name="roles[]" class="form-control form-select form-select-sm select2 form-control-sm" multiple required>
                                    @foreach ($roles as $key=>$item)
                                        <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
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