@extends('components.layouts.app')
@section('titulo')
HB GROUP - Gestion de Empresas
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Gestion de Empresas</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Academico</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gestion de Empresas</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    @if (in_array(22,$array_accesos))
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-status bg-blue br-te-7 br-ts-7"></div> --}}
                <div class="card-header">
                    <h3 class="card-title">Lista de Empresas</h3>
                    <div class="card-options">
                        @if (in_array(23,$array_accesos))
                        <a href="javascript:void(0)" class="btn btn-success btn-sm" id="nuevo" ><i class="fe fe-plus"></i> Nuevo Empresas</a>
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
                                        <th class="wd-15p border-bottom-0">Ruc</th>
                                        <th class="wd-15p border-bottom-0">Razon Social</th>
                                        <th class="wd-20p border-bottom-0">Dirección</th>
                                        <th class="wd-20p border-bottom-0">Email</th>
                                        <th class="wd-20p border-bottom-0">Celular</th>
                                        <th class="wd-20p border-bottom-0">Fecha de Registro</th>
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
    <div class="modal fade effect-super-scaled " id="modal-empresa">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Nuevo Alumno</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="guardar" action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="0">
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="form-label">Ruc : <span class="text-red">*</span></label>
                                    <input type="text" name="ruc" class="form-control form-control-sm" placeholder="Ruc..." data-search="ruc" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="form-label">Razon Social : <span class="text-red">*</span></label>
                                    <input type="text" name="razon_social" class="form-control form-control-sm" placeholder="Razon Social..." required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="form-label">Email : <span class="text-red">*</span></label>
                                    <input type="email" name="email" class="form-control form-control-sm" placeholder="Email..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group ">
                                    <label class="form-label">Dirección : <span class="text-red">*</span></label>
                                    <input type="text" name="direccion" class="form-control form-control-sm" placeholder="Dirección..." required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="form-label">Celular : <span class="text-red">*</span></label>
                                    <input type="number" name="celular" class="form-control form-control-sm" placeholder="Celular..." required>
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

    {{-- <script src="{{asset('template/plugins/extension-datatable/autofill/dataTables.autoFill.min.js')}}"></script>
    <script src="{{asset('template/plugins/extension-datatable/autofill/autoFill.bootstrap5.min.js')}}"></script>
    <script src="{{asset('template/plugins/extension-datatable/keytable/dataTables.keyTable.min.js')}}"></script> --}}

    {{-- <script src="{{asset('template/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/js/buttons.colVis.min.js')}}"></script> --}}
    <script src="{{asset('template/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatable/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('template/js/table-data.js')}}"></script>

    <script src="{{asset('components/empresas/empresa-model.js')}}"></script>
    <script src="{{asset('components/empresas/empresa-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new EmpresaView(new EmpresaModel(csrf_token));
            view.listar();
            view.eventos();
        });



    </script>
@endsection
