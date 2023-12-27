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
                <li class="breadcrumb-item active" aria-current="page">Gestion de Certificados</li>
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
                        <h3 class="card-title">Lista de Certificados
                            {{-- <i class="fe fe-help-circle protip text-warning fs-20" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Exportar certificado"></i>  --}}
                        </h3>
                        <div class="card-options">
                            {{-- @if (in_array(6,$array_accesos))
                                <a href="{{ route('hb.academicos.alumnos.modelo-importar-alumnos-excel') }}" class="btn btn-info btn-sm" ><i class="fe fe-download"></i> Modelo de excel</a>
                            @endif
                            @if (in_array(5,$array_accesos))
                            <a href="javascript:void(0)" class="btn btn-info btn-sm ms-2" id="carga-excel" ><i class="fe fe-upload"></i> Carga masiva de Alumnos</a>
                            @endif
                            @if (in_array(2,$array_accesos)) --}}
                            <a href="javascript:void(0)" class="btn btn-default btn-sm ms-2 d-none d-lg-block d-md-block" data-action="filtros"><i class="fe fe-filter"></i> Filtros</a>
                            <a href="javascript:void(0)" class="btn btn-default btn-sm ms-2 d-none d-lg-block d-md-block" data-action="pdf-masivo"><i class="fa fa-file-pdf-o"></i> Exportar PDF Masivo</a>

                            <a href="{{ route('hb.academicos.certificados.certificado-modelo-excel') }}" class="btn btn-info btn-sm ms-2 d-none d-lg-block d-md-block" data-action="modelo"><i class="fe fe-download"></i> Modelo de excel</a>
                            <a href="javascript:void(0)" class="btn btn-info btn-sm ms-2 d-none d-lg-block d-md-block" data-action="importar" id="importar" ><i class="fe fe-upload"></i> Importarción Certificado</a>
                            <a href="javascript:void(0)" class="btn btn-success btn-sm ms-2 d-none d-lg-block d-md-block" data-action="nuevo"><i class="fe fe-plus"></i> Nuevo Certificado</a>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                                <a href="javascript:void(0)" class="btn btn-default btn-sm ms-2 d-block d-md-none mb-2" data-action="filtros"><i class="fe fe-filter"></i> Filtros</a>
                                <a href="javascript:void(0)" class="btn btn-default btn-sm ms-2 d-block d-md-none mb-2" data-action="pdf-masivo"><i class="fa fa-file-pdf-o"></i> Exportar PDF Masivo</a>

                                <a href="{{ route('hb.academicos.certificados.certificado-modelo-excel') }}" class="btn btn-info btn-sm ms-2 d-block d-md-none mb-2" data-action="modelo"><i class="fe fe-download"></i> Modelo de excel</a>
                                <a href="javascript:void(0)" class="btn btn-info btn-sm ms-2 d-block d-md-none mb-2" data-action="importar" id="importar" ><i class="fe fe-upload"></i> Importarción Certificado</a>
                                <a href="javascript:void(0)" class="btn btn-success btn-sm ms-2 d-block d-md-none mb-2" data-action="nuevo"><i class="fe fe-plus"></i> Nuevo Certificado</a>


                            <div class="col-md-12 table-responsive">


                                <table class="table table-bordered text-nowrap border-bottom table-hover" id="tabla-data"
                                {{-- style="width: 100%; font-size: x-small" --}}
                                width="100%">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0" width="">#</th>
                                            <th class="border-bottom-0" width="">Código</th>
                                            <th class="border-bottom-0" width="">Curso</th>
                                            <th class="border-bottom-0" width="">N° Documento</th>
                                            <th class="border-bottom-0" width="">Apellidos y Nombres</th>
                                            <th class="border-bottom-0">Empresa</th>
                                            <th class="border-bottom-0">Estado</th>
                                            <th class="border-bottom-0">Nota</th>
                                            <th class="border-bottom-0">Email</th>
                                            <th class="border-bottom-0">-</th>
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
    <div class="modal fade effect-super-scaled " id="modal-importar">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Importar excel</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="guardar-certificado" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="0">
                    <div class="modal-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label mt-0">Importar : <span class="text-red">*</span></label>
                                    <input class="form-control form-control-sm" type="file" accept=".xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="certificado" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none" id="tabla-excluido">
                            <div class="col-md-12">
                                <table class="table table-bordered text-nowrap border-bottom table-hover table-sm table-responsive" id="tabla-data"
                                {{-- style="width: 100%; font-size: x-small" --}}
                                width="100%">
                                    <thead>
                                        <tr>
                                            <th style="" width="15"> FECHA DE CURSO </th>
                                            <th style="" width="20"> CURSO </th>
                                            {{-- <th style="" width="20"> TIPO DE CURSO </th> --}}
                                            <th style="" width="20"> TIPO DE DOCUMENTO </th>
                                            <th style="" width="20"> N° DE DOCUMENTO </th>

                                            <th style="" width="20"> APELLIDO PATERNO </th>
                                            <th style="" width="20"> APELLIDO MATERNO </th>
                                            <th style="" width="20"> NOMBRES </th>

                                            {{-- <th style="" width="20"> EMPRESA </th>
                                            <th style="" width="10"> CARGO </th>
                                            <th style="" width="15"> CORREO ELECTRONICO </th>
                                            <th style="" width="20"> SUPERVISOR RESPONSABLE </th>
                                            <th style="" width="20"> OBSERVACIONES </th> --}}

                                            <th style="" width="20"> CURSO(CODIGO DEL CURSO) </th>
                                            <th style="" width="20"> COD </th>
                                            {{-- <th style="" width="20"> LETRA </th>
                                            <th style="" width="20"> AAAA </th>
                                            <th style="" width="20"> MM </th>
                                            <th style="" width="20"> DD </th> --}}
                                            <th style="" width="20"> NOTA </th>
                                            <th style="" width="20"> CODIGO CERTIFICADO </th>
                                            <th style="" width="20"> DURACION </th>
                                            <th style="" width="20"> FECHA VENCIMIENTO </th>
                                            {{-- <th style="" width="20"> COMENTARIO </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody data-table="excluidos">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fe fe-save fe-spin"></i> Guardar</button>
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"><i class="fe fe-x"></i> Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL filtros -->
    <div class="modal fade effect-super-scaled " id="modal-filtros">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Filtros</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="form-filtros" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row justify-content-md-center" data-section="curso">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="checkedcurso" value="curso">
                                        <span class="custom-control-label">Curso :</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group select2-sm ">
                                    <select name="curso" class="form-control form-select select2-show-search " data-disabled="cheked" data-placeholder="Seleccione..." disabled>
                                        <option value="">Seleccione...</option>
                                        @foreach ($cursos as $key=>$item)
                                            <option value="{{ $item->curso }}">{{ $item->curso }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center" data-section="empresa">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="checkedempresa" value="empresa">
                                        <span class="custom-control-label">Empresa :</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group select2-sm ">
                                    <select name="empresa" class="form-control form-select form-select-sm select2-show-search "  data-disabled="cheked" disabled>
                                        <option value="vacio" selected>--Vacío--</option>
                                        @foreach ($empresas as $key=>$item)
                                            <option value="{{ $item->empresa }}" >{{  $item->empresa }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-md-center" data-section="documento">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="checkednumero_documento" value="numero_documento">
                                        <span class="custom-control-label">N°Documento :</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group select2-sm ">
                                    <select name="numero" class="form-control form-select form-select-sm select2-show-search "  data-disabled="cheked" data-placeholder="Seleccione..."disabled>
                                        <option value="" selected>Seleccione...</option>
                                        @foreach ($documentos as $key=>$item)
                                            <option value="{{ $item->numero_documento }}" >{{  $item->numero_documento }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-md-center" data-section="fecha">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="checkedfechas" value="fechas">
                                        <span class="custom-control-label">Fechas :</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group text-center">
                                    <input class="form-control form-control-sm text-center" type="date" name="fecha_inicio" disabled data-disabled="cheked">
                                    <small id="helpId" class="text-muted">Fecha Inicio</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group text-center">
                                    <input class="form-control form-control-sm text-center" type="date" name="fecha_final" disabled data-disabled="cheked">
                                    <small id="helpId" class="text-muted">Fecha Final</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="submit" class="btn btn-success btn-sm"><i class="fe fe-save fe-spin"></i> Guardar</button> --}}
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal" id="aplicar"><i class="fe fe-thumbs-up"></i> Aplicar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- MODAL ver  -->
     <div class="modal fade effect-super-scaled " id="modal-ver">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">
                        <i class="fa fa-search"></i>
                    </h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">
                        &times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Codigo Certificado :</p> <label id="cod_certificado">sss</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Fecha de curso :</p> <label id="fecha_curso">sss</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Duracion :</p> <label id="duracion">sss</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Nota :</p> <label id="nota">sss</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Tipo de Curso :</p> <label id="tipo_curso">sss</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Curso :</p> <label id="curso">sss</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Fecha de Vencimiento :</p> <label id="fecha_vencimiento">sss</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Tipos de Documentos :</p> <label id="tipo_documento_id">sss</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Número de Documento :</p> <label id="numero_documento">sss</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Empresa :</p> <label id="empresa">sss</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Apellido Paterno :</p> <label id="apellido_paterno">sss</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Apellido Materno :</p> <label id="apellido_materno">sss</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Nombres :</p> <label id="nombres">sss</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Cargo  :</p> <label id="cargo">sss</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Email  :</p> <label id="email">sss</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Supervisor Responsable :</p> <label id="supervisor_responsable">sss</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Observaciones :</p> <label id="observaciones">sss</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p for="my-input"class="fw-bold">Comentario :</p> <label id="comentario">sss</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="submit" class="btn btn-success btn-sm"><i class="fe fe-save fe-spin"></i> Guardar</button> --}}
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"><i class="fe fe-x"></i> Cerrar</button>
                </div>
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

    <script src="{{asset('components/academico/certificados/certificado-model.js')}}"></script>
    <script src="{{asset('components/academico/certificados/certificado-view.js')}}"></script>
    <script>
        // Select2

        var filtros = {
            _token:csrf_token,
            curso:'-',
            empresa:'-',
            documento:'-',
            fecha_inicio:'-',
            fecha_final:'-',
        };
        $(document).ready(function () {
            $('.select2-show-search').select2({
                minimumResultsForSearch: '',
                width: '100%',
                dropdownParent: $('#modal-filtros .modal-body')
            });

            const view = new CertificadoView(new CertificadoModel(csrf_token));
            view.listar();
            view.eventos();
            view.filtros();
        });



    </script>
@endsection
