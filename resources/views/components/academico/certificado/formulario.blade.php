@extends('components.layouts.app')
@section('titulo')
HB GROUP - Gestion de Alumnos
@endsection
@section('css')
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Gestion de Certificados</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Academico</a></li>
                <li class="breadcrumb-item"><a href="{{ route('hb.academicos.certificados.lista') }}">Gestion de Certificados</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$tipo}}</li>
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
                        <h3 class="card-title">{{$tipo}}</h3>
                        <div class="card-options">
                            {{-- @if (in_array(6,$array_accesos))
                                <a href="{{ route('hb.academicos.alumnos.modelo-importar-alumnos-excel') }}" class="btn btn-info btn-sm" ><i class="fe fe-download"></i> Modelo de excel</a>
                            @endif
                            @if (in_array(5,$array_accesos))
                            <a href="javascript:void(0)" class="btn btn-info btn-sm ms-2" id="carga-excel" ><i class="fe fe-upload"></i> Carga masiva de Alumnos</a>
                            @endif
                            @if (in_array(2,$array_accesos)) --}}
                            {{-- <a href="javascript:void(0)" class="btn btn-success btn-sm ms-2" id="nuevo" ><i class="fe fe-plus"></i> Nuevo Certificado</a> --}}
                            {{-- @endif --}}
                        </div>
                    </div>
                    <form action="" id="guardar">
                        @csrf
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="cod_certificado">Codigo Certificado<span class="text-danger">*</span> : </label>
                                        <input id="cod_certificado" class="form-control form-control-sm" type="text" name="cod_certificado" data-action="unico" required value="{{ ($data ? $data->cod_certificado :'') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fecha_curso">Fecha de curso<span class="text-danger">*</span> :</label>
                                        <input id="fecha_curso" class="form-control form-control-sm" type="date" name="fecha_curso" required value="{{ ($data ? $data->fecha_curso :'') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="duracion">Duracion<span class="text-danger">*</span> :</label>
                                        <input id="duracion" class="form-control form-control-sm" type="number" name="duracion" step="0.01" required value="{{ ($data ? $data->duracion :'') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="nota">Nota<span class="text-danger">*</span> :</label>
                                        <input id="nota" class="form-control form-control-sm" type="number" name="nota" step="0.01" required value="{{ ($data ? $data->nota :'') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipo_curso">Tipo de Curso :</label>
                                        <input id="tipo_curso" class="form-control form-control-sm" type="text" name="tipo_curso" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="curso">Curso<span class="text-danger">*</span> :</label>
                                        <input id="curso" class="form-control form-control-sm" type="text" name="curso" value="{{ ($data ? $data->curso :'') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_vencimiento">Fecha de Vencimiento<span class="text-danger">*</span> :</label>
                                        <input id="fecha_vencimiento" class="form-control form-control-sm" type="date" name="fecha_vencimiento" value="{{ ($data ? $data->fecha_vencimiento :'') }}" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group select2-sm">
                                        <label>Tipos de Documentos : <span class="text-red">*</span></label>
                                        <select name="tipo_documento_id" class="form-control form-select form-select-sm select2" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tipos_documentos as $key=>$item)
                                                <option value="{{ $item->id }}" {{ ($data ? ($data->tipo_documento_id==$item->id?'selected':'') :'') }}>{{ $item->codigo . ' - ' . $item->descripcion }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="numero_documento">Número de Documento :<span class="text-danger">*</span></label>
                                        <input id="numero_documento" class="form-control form-control-sm" type="text" name="numero_documento" value="{{ ($data ? $data->numero_documento :'') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="empresa">Empresa :</label>
                                        <input id="empresa" class="form-control form-control-sm" type="text" name="empresa" value="{{ ($data ? $data->empresa :'') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_paterno">Apellido Paterno<span class="text-danger">*</span> :</label>
                                        <input id="apellido_paterno" class="form-control form-control-sm" type="text" name="apellido_paterno" value="{{ ($data ? $data->apellido_paterno :'') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_materno">Apellido Materno<span class="text-danger">*</span> :</label>
                                        <input id="apellido_materno" class="form-control form-control-sm" type="text" name="apellido_materno" value="{{ ($data ? $data->apellido_materno :'') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombres"> Nombres<span class="text-danger">*</span> :</label>
                                        <input id="nombres" class="form-control form-control-sm" type="text" name="nombres" value="{{ ($data ? $data->nombres :'') }}" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cargo">Cargo :</label>
                                        <input id="cargo" class="form-control form-control-sm" type="text" value="{{ ($data ? $data->cargo :'') }}" name="cargo">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email :</label>
                                        <input id="email" class="form-control form-control-sm" type="email" name="email" value="{{ ($data ? $data->email :'') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="supervisor_responsable">Supervisor Responsable :</label>
                                        <input id="supervisor_responsable" class="form-control form-control-sm" type="text" name="supervisor_responsable" value="{{ ($data ? $data->supervisor_responsable :'') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones :</label>
                                        <textarea name="observaciones" class="form-control form-control-sm" id="observaciones" rows="2">{{ ($data ? $data->observaciones :'') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="comentario">Comentario :</label>
                                        <textarea name="comentario" class="form-control form-control-sm" id="" cols="3" rows="2">{{ ($data ? $data->comentario :'') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Guardar</button>
                            <a href="{{ route('hb.academicos.certificados.lista') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-left"></i> Volver</a>
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

    <script src="{{asset('components/academico/certificados/certificado-model.js')}}"></script>
    <script src="{{asset('components/academico/certificados/certificado-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new CertificadoView(new CertificadoModel(csrf_token));
            // view.listar();
            view.eventos();
        });



    </script>
@endsection
