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
            <li class="breadcrumb-item"><a href="javascript:void(0)">Gestion de Usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$tipo}}</li>
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
                <h3 class="card-title">{{$tipo}}</h3>
                <div class="card-options">
                    {{-- <a href="javascript:void(0)" class="btn btn-success btn-sm" id="nuevo" ><i class="fe fe-plus"></i> Nuevo Usuario</a> --}}
                </div>
            </div>
            <form id="guardar" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <input type="hidden" name="id" value="{{$id}}">
                    {{-- <div class="modal-body"> --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group select2-sm">
                                <label class="form-label">Tipos de Documentos : <span class="text-red">*</span></label>
                                <select name="tipo_documento_id" class="form-control form-select form-select-sm select2" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($tipos_documentos as $key=>$item)
                                        <option value="{{ $item->id }}" {{ ($persona?($persona->tipo_documento_id==$item->id?'selected':''):'') }} >{{ $item->descripcion }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">N° Documento : <span class="text-red">*</span></label>
                                <input type="text" name="nro_documento" class="form-control form-control-sm" placeholder="Número de documento..." data-search="usuario" data-tipo="documento" value="{{($persona?$persona->nro_documento:null)}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Apellido Paterno : <span class="text-red">*</span></label>
                                <input type="text" name="apellido_paterno" class="form-control form-control-sm" placeholder="Apellido Paterno..." value="{{($persona?$persona->apellido_paterno:null)}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Apellido Materno : <span class="text-red">*</span></label>
                                <input type="text" name="apellido_materno" class="form-control form-control-sm" placeholder="Apellido Materno..." value="{{($persona?$persona->apellido_materno:null)}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Nombres : <span class="text-red">*</span></label>
                                <input type="text" name="nombres" class="form-control form-control-sm" value="{{($persona?$persona->nombres:null)}}" placeholder="Nombres..." required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Whatsapp : </label>
                                <input type="number" name="whatsapp" class="form-control form-control-sm" value="{{($persona?$persona->whatsapp:null)}}" placeholder="Whatsapp...">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Nacionalidad : </label>
                                <input type="text" name="nacionalidad" class="form-control form-control-sm" placeholder="Nacionalidad..." value="{{($persona?$persona->nacionalidad:null)}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Cargo : </label>
                                <input type="text" name="cargo" class="form-control form-control-sm" placeholder="Cargo..." value="{{($persona?$persona->cargo:null)}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Telefono : </label>
                                <input type="number" name="telefono" class="form-control form-control-sm" placeholder="Telefono..."value="{{($persona?$persona->telefono:null)}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group select2-sm">
                                <label class="form-label">Sexo : <span class="text-red">*</span></label>
                                <select name="sexo" class="form-control form-select form-select-sm select2" required>
                                    <option value="">Seleccione...</option>
                                    <option value="M" {{($persona?('M'==$persona->sexo?'selected':''):'')}}>Masculino</option>
                                    <option value="F" {{($persona?('F'==$persona->sexo?'selected':''):'')}}>Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group select2-sm">
                                <label class="form-label">Empresa : <span class="text-red">*</span></label>
                                <select name="empresa_id" class="form-control form-select form-select-sm select2" required>
                                    <option value="">Seleccione...</option>
                                    @foreach ($empresas as $key=>$item)
                                        <option value="{{ $item->id }}" {{ ($usuario?($usuario->empresa_id==$item->id?'selected':''):'') }}>{{ $item->razon_social }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Imagen de DNI : <span class="text-red">*</span></label>
                                <input type="file" name="path_dni" class="form-control form-control-sm" placeholder="path_dni..." accept=".jpg,.png">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Fecha de Cumpleaños : <span class="text-red">*</span></label>
                                <input type="date" name="fecha_cumpleaños" class="form-control form-control-sm text-center"  required value="{{($persona?$persona->fecha_cumpleaños:null)}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Fecha de Caducidad de DNI : <span class="text-red">*</span></label>
                                <input type="date" name="fecha_caducidad_dni" class="form-control form-control-sm text-center"  required value="{{($persona?$persona->fecha_caducidad_dni:null)}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Email : <span class="text-red">*</span></label>
                                <input type="email" name="email" class="form-control form-control-sm text-center" placeholder="email@hotmail.com..." data-search="usuario" data-tipo="email" value="{{($usuario?$usuario->email:null)}}" required>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group select2-sm">
                                <label class="form-label">Roles : <span class="text-red">*</span></label>
                                <select name="roles[]" class="form-control form-select form-select-sm select2 form-control-sm" multiple required>
                                    @foreach ($roles as $key=>$item)
                                        <option value="{{ $item->id }}" {{ (in_array($item->id, $roles_id)?'selected':'') }}>{{ $item->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- </div> --}}
                    {{-- <div class="modal-footer"> --}}

                    {{-- </div> --}}

                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fe fe-save"></i> Guardar</button>
                    <a href="{{route('hb.configuraciones.usuarios.lista')}}" class="btn btn-danger btn-sm" ><i class="fa fa-arrow-circle-left"></i> Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ROW-1 END -->
@endsection

@section('script')

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{asset('template/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('template/js/select2.js')}}"></script>


    <script src="{{asset('components/configuraciones/usuarios/usuario-model.js')}}"></script>
    <script src="{{asset('components/configuraciones/usuarios/usuario-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new UsuarioView(new UsuarioModel(csrf_token));
            view.eventos();
        });



    </script>
@endsection
