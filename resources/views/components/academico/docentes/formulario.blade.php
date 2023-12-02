@extends('components.layouts.app')
@section('titulo')
HB GROUP - Gestion de Alumnos
@endsection
@section('css')
<style>
</style>
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Gestion de Docentes</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Academico</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Gestion de Docentes</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $tipo }}</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    {{-- @if (in_array(1,$array_accesos)) --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-status bg-blue br-te-7 br-ts-7"></div> --}}
                    <div class="card-header">
                        <h3 class="card-title">{{ $tipo }}</h3>
                    </div>
                    <form id="guardar" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group select2-sm">
                                        <label class="form-label">Tipos de Documentos : <span class="text-red">*</span></label>
                                        <select name="tipo_documento_id" class="form-control form-select form-select-sm select2" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tipos_documentos as $key=>$item)
                                                <option value="{{ $item->id }}" {{ ($persona?($persona->tipo_documento_id==$item->id?'selected':''):'') }}>{{ $item->codigo . ' - ' . $item->descripcion }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class="form-label">N° Documento : <span class="text-red">*</span></label>
                                        <input type="text" name="nro_documento" class="form-control form-control-sm" placeholder="Número de documento..." data-search="numero_documento" data-tipo="documento" value="{{($persona?$persona->nro_documento:null)}}" required>
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
                                        <input type="number" name="whatsapp" class="form-control form-control-sm" placeholder="Whatsapp..." value="{{($persona?$persona->whatsapp:null)}}">
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
                                        <input type="number" name="telefono" class="form-control form-control-sm" placeholder="Telefono..." value="{{($persona?$persona->telefono:null)}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group select2-sm">
                                        <label class="form-label">Sexo : <span class="text-red">*</span></label>
                                        <select name="sexo" class="form-control form-select form-select-sm select2" required>
                                            <option value="">Seleccione...</option>
                                            <option value="M" {{($persona?(('M'==$persona->sexo?'selected':'')):'')}}>Masculino</option>
                                            <option value="F" {{($persona?(('F'==$persona->sexo?'selected':'')):'')}}>Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group select2-sm">
                                        <label class="form-label">Empresa : <span class="text-red">*</span></label>
                                        <select name="empresa_id" class="form-control form-select form-select-sm select2" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($empresas as $key=>$item)
                                                <option value="{{ $item->id }}" {{ ($usuario?($usuario->empresa_id==$item->id?'selected':''):'') }}  >{{ $item->razon_social }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class="form-label">Imagen de DNI : <span class="text-red">*</span></label>
                                        <input type="file" name="path_dni" class="form-control form-control-sm" placeholder="path_dni..." accept=".jpg,.png">
                                    </div>
                                </div> --}}

                            </div>
                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Fecha de Cumpleaños : <span class="text-red">*</span></label>
                                        <input type="date" name="fecha_cumpleaños" class="form-control form-control-sm text-center" value="{{($persona?$persona->fecha_cumpleaños:null)}}"  required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Fecha de Caducidad de DNI : <span class="text-red">*</span></label>
                                        <input type="date" name="fecha_caducidad_dni" class="form-control form-control-sm text-center" value="{{($persona?$persona->fecha_caducidad_dni:null)}}"  required>
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Email : <span class="text-red">*</span></label>
                                        <input type="email" name="email" class="form-control form-control-sm text-center" placeholder="email@hotmail.com..." data-search="numero_documento" data-tipo="email" value="{{($usuario?$usuario->email:null)}}" required>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fe fe-save"></i> Guardar</button>
                            <a href="{{ route('hb.academicos.docentes.lista') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-left"></i> volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    {{-- @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <span class="alert-inner--icon"><i class="fe fe-bell"></i></span>
                    <span class="alert-inner--text"><strong>Información!</strong> Solicite los accesos al administrador</span>
                </div>
            </div>
        </div>
    @endif --}}

    <!-- ROW-1 END -->

    <!-- MODAL EFFECTS -->
    <div class="modal fade effect-super-scaled " id="modal-alumno">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Nuevo Alumno</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{asset('template/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('template/js/select2.js')}}"></script>


    <script src="{{asset('components/academico/docentes/docente-model.js')}}"></script>
    <script src="{{asset('components/academico/docentes/docente-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new DocenteView(new DocenteModel(csrf_token));
            // view.listar();
            view.eventos();
        });



    </script>
@endsection
