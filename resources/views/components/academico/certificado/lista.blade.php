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
                        <h3 class="card-title">Lista de Certificados</h3>
                        <div class="card-options">
                            {{-- @if (in_array(6,$array_accesos))
                                <a href="{{ route('hb.academicos.alumnos.modelo-importar-alumnos-excel') }}" class="btn btn-info btn-sm" ><i class="fe fe-download"></i> Modelo de excel</a>
                            @endif
                            @if (in_array(5,$array_accesos))
                            <a href="javascript:void(0)" class="btn btn-info btn-sm ms-2" id="carga-excel" ><i class="fe fe-upload"></i> Carga masiva de Alumnos</a>
                            @endif
                            @if (in_array(2,$array_accesos)) --}}
                            <a href="{{ route('hb.academicos.certificados.certificado-modelo-excel') }}" class="btn btn-info btn-sm ms-2" id="modelo" ><i class="fe fe-download"></i> Modelo de excel</a>
                            <a href="javascript:void(0)" class="btn btn-info btn-sm ms-2" id="importar" ><i class="fe fe-upload"></i> Importarción Certificado</a>
                            <a href="javascript:void(0)" class="btn btn-success btn-sm ms-2" id="nuevo" ><i class="fe fe-plus"></i> Nuevo Certificado</a>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <table class="table table-bordered text-nowrap border-bottom table-hover " id="tabla-data"
                                {{-- style="width: 100%; font-size: x-small" --}}
                                width="100%">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0" width="">#</th>
                                            <th class="wd-15p border-bottom-0" width="">Código</th>
                                            <th class="wd-15p border-bottom-0" width="">Curso</th>
                                            <th class="wd-15p border-bottom-0" width="">N° Documento</th>
                                            <th class="wd-15p border-bottom-0" width="">Apellidos y Nombres</th>
                                            <th class="wd-15p border-bottom-0">Empresa</th>
                                            <th class="wd-15p border-bottom-0">Email</th>
                                            <th class="wd-15p border-bottom-0">Nota</th>
                                            <th class="wd-15p border-bottom-0">Estado</th>
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
                                    <label class="form-label mt-0">Seleccione un archivo</label>
                                    <input class="form-control form-control-sm" type="file" accept=".xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="certificado" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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

    <script src="{{asset('components/academico/certificados/certificado-model.js')}}"></script>
    <script src="{{asset('components/academico/certificados/certificado-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new CertificadoView(new CertificadoModel(csrf_token));
            view.listar();
            view.eventos();
        });



    </script>
@endsection
