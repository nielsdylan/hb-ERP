
@extends('components.configuraciones.app-configuraciones')
@section('titulo')
HB GROUP - Gestion de Tipo de Monedas
@endsection
@section('content')
@section('configuracion-page-header')
<div class="page-header">
    <h1 class="page-title">Gestion de Tipo de Monedas</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Configuraciones</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestion de Tipo de Monedas</li>
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
                <h3 class="card-title">Lista de Tipo de Monedas</h3>
                <div class="card-options">
                    <a href="javascript:void(0)" class="btn btn-success btn-sm" id="nuevo" ><i class="fe fe-plus"></i> Nuevo Tipo de Moneda</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-md-center">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom table-hover" id="tabla-data" width="100%">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Descripción</th>
                                    <th class="wd-15p border-bottom-0">Simbolo</th>
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
<!-- ROW-1 END -->

<!-- MODAL EFFECTS -->
<div class="modal fade effect-super-scaled " id="modal-moneda">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Nuevo Tipo de Documento</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="guardar" action="" method="POST">
                @csrf
                <input type="hidden" name="id" value="0">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="form-label">Descripción : <span class="text-red">*</span></label>
                                <input type="text" name="descripcion" class="form-control form-control-sm" placeholder="Descripción..." data-search="descripcion" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="form-label">Simbolo : <span class="text-red">*</span></label>
                                <input type="text" name="simbolo" class="form-control form-control-sm" placeholder="Descripción..." data-search="descripcion" required>
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

    <script src="{{asset('components/configuraciones/tipo-monedas/tipo_moneda-model.js')}}"></script>
    <script src="{{asset('components/configuraciones/tipo-monedas/tipo_moneda-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new TipoMonedaView(new TipoMonedaModel(csrf_token));
            view.listar();
            view.eventos();
        });



    </script>
@endsection
