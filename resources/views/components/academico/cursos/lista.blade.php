@extends('components.layouts.app')
@section('titulo')
HB GROUP - Gestion de Cursos
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Gestion de Cursos</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Configuraciones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gestion de Cursos</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    @if (in_array(12,$array_accesos))
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-status bg-blue br-te-7 br-ts-7"></div> --}}
                <div class="card-header">
                    <h3 class="card-title">Lista des Cursos</h3>
                    <div class="card-options">
                        @if (in_array(13,$array_accesos))
                        <a href="javascript:void(0)" class="btn btn-success btn-sm" id="nuevo" ><i class="fe fe-plus"></i> Nuevo Curso</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-md-center">
                        <div class="col-md-8 table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom table-hover " id="tabla-data" width="100%">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">Código</th>
                                        <th class="wd-15p border-bottom-0">Nombre</th>
                                        <th class="wd-15p border-bottom-0">Asignatura</th>
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
    <div class="modal fade effect-super-scaled " id="modal-curso">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Nuevo Curso</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="guardar" action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="0">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-label">Código : <span class="text-red">*</span></label>
                                    <input type="text" name="codigo" class="form-control form-control-sm" placeholder="Código..." data-search="codigo" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-label">Descripción : <span class="text-red">*</span></label>
                                    <input type="text" name="descripcion" class="form-control form-control-sm" placeholder="Descripción..." data-search="descripcion" required>
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

    <script src="{{asset('components/academico/cursos/curso-model.js')}}"></script>
    <script src="{{asset('components/academico/cursos/curso-view.js')}}"></script>
    <script>
        // Select2

        $(document).ready(function () {
            const view = new CursoView(new CursoModel(csrf_token));
            view.listar();
            view.eventos();
        });



    </script>
@endsection
