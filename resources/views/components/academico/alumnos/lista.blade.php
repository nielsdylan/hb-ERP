@extends('components.layouts.app')
@section('titulo')
HB GROUP - Gestion de Alumnos
@endsection
@section('css')
<style>
    .btn-pulse-info {
        -webkit-animation: pulse-black 1.5s linear infinite;
    }
    @keyframes  pulse-black{
        0%{
            -webkit-transform:scale(1);
            transform:scale(1);
            box-shadow:0 0 0 0 #1170e4
        }
        70%{
            -webkit-transform:scale(1);
            transform:scale(1);
            box-shadow:0 0 0 10px transparent
        }
        100%{
            -webkit-transform:scale(1);
            transform:scale(1);
            box-shadow:0 0 0 0 transparent
        }
    }
    a.list-group-item span.badge {
        position: absolute;
        inset-block-start: 18px;
        inset-inline-end: 20px;
    }
</style>
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Gestion de Alumnos</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Academico</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gestion de Alumnos</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    @if (in_array(1,$array_accesos))
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-status bg-blue br-te-7 br-ts-7"></div> --}}
                    <div class="card-header">
                        <h3 class="card-title">Lista de Alumnos</h3>
                        <div class="card-options">
                            @if (in_array(6,$array_accesos))
                                <a href="{{ route('hb.academicos.alumnos.modelo-importar-alumnos-excel') }}" class="btn btn-info btn-sm" ><i class="fe fe-download"></i> Modelo de excel</a>
                            @endif
                            @if (in_array(5,$array_accesos))
                            <a href="javascript:void(0)" class="btn btn-info btn-sm ms-2" id="carga-excel" ><i class="fe fe-upload"></i> Carga masiva de Alumnos</a>
                            @endif
                            @if (in_array(2,$array_accesos))
                            <a href="javascript:void(0)" class="btn btn-success btn-sm ms-2" id="nuevo" ><i class="fe fe-plus"></i> Nuevo alumno</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom table-hover" id="tabla-data" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">#</th>
                                            <th class="wd-15p border-bottom-0">N° Documento</th>
                                            <th class="wd-15p border-bottom-0">Apellidos yNombres</th>
                                            <th class="wd-20p border-bottom-0">Correo Electronico</th>
                                            <th class="wd-20p border-bottom-0">Cargo</th>
                                            <th class="wd-20p border-bottom-0">Telefono</th>
                                            <th class="wd-20p border-bottom-0">Sexo</th>
                                            <th class="wd-20p border-bottom-0">Fecha Caducidad</th>
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
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <span class="alert-inner--icon"><i class="fe fe-bell"></i></span>
                    <span class="alert-inner--text"><strong>Información!</strong> Solicite los accesos al administrador</span>
                </div>
            </div>
        </div>
    @endif

    <!-- ROW-1 END -->

    <!-- MODAL EFFECTS -->
    <div class="modal fade effect-super-scaled " id="modal-alumno">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Nuevo Alumno</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
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
                                            <option value="{{ $item->id }}">{{ $item->codigo . ' - ' . $item->descripcion }}</option>
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fe fe-save"></i> Guardar</button>
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"><i class="fe fe-x"></i> Cerrar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- MODAL EFFECTS -->
    <div class="modal fade effect-super-scaled " id="modal-importar">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Importar Alumnos</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="form-importar" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="0">
                    <div class="modal-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-label">Importar : <span class="text-red">*</span></label>
                                    <input type="file" name="importar_excel" class="form-control form-control-sm" required>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="tabla-excluido">
                            <div class="col-md-12" data-table="respuesta">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fe fe-save"></i> Guardar</button>
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"><i class="fe fe-x"></i> Cerrar</button>
                    </div>
                </form>

            </div>
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

    <script src="{{asset('components/academico/alumnos/alumno-model.js')}}"></script>
    <script src="{{asset('components/academico/alumnos/alumno-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new AlumnoView(new AlumnoModel(csrf_token));
            view.listar();
            view.eventos();
        });



    </script>
@endsection
