@extends('components.layouts.app')
@section('titulo')
HB GROUP - Agregar Participantes
@endsection
@section('css')
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Agregar Participantes</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Academico</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Gestion de Aulas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Agregar Participantes</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    <div class="row justify-content-md-center">
        <div class="col-md-10">
            <div class="card">
                
                <form id="guardar">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button class="btn btn-success"><i class="fa fa-plus"></i> Guardar</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-5">
                                <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>N° de Documento</th>
                                            <th>Apellidos yNombres</th>
                                            <th>Fecha registro</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <!-- ROW-1 END -->


</div>
@endsection

@section('script')

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{asset('template/plugins/select2/select2.full.min.js')}}"></script>
    {{-- <script src="{{asset('template/js/select2.js')}}"></script> --}}

    <!-- DATEPICKER JS -->
    <script src="{{asset('template/plugins/date-picker/date-picker.js')}}"></script>
    <script src="{{asset('template/plugins/date-picker/jquery-ui.js')}}"></script>
    <script src="{{asset('template/plugins/input-mask/jquery.maskedinput.js')}}"></script>

    <script src="{{asset('components/academico/aulas/aula-model.js')}}"></script>
    <script src="{{asset('components/academico/aulas/aula-view.js')}}"></script>
    <script>
        // Select2
        
        $(document).ready(function () {
            // DATEPICKER
            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                // language:'es'
            });
            // Select2 by showing the search
            $('.select2-show-search').select2({
                minimumResultsForSearch: '',
                width: '100%'
            });
            const view = new AulaView(new AulaModel(csrf_token));
            view.eventos();
        });



    </script>
@endsection