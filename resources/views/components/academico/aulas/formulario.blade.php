@extends('components.layouts.app')
@section('titulo')
HB GROUP - Gestion de Aula
@endsection
@section('css')
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Gestion de Aulas</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Academico</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Gestion de Aulas</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $tipo }}</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $tipo }}</h3>{{ ($aula ? ' : '.$aula->codigo : null) }}
                </div>
                <form id="guardar">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="codigo" class="form-label">Código : <span class="text-red">*</span></label>
                                    <input type="text" name="codigo" class="form-control form-control-sm" id="codigo" placeholder="Código...." value="{{ ($aula?$aula->codigo:'') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group select2-sm">
                                    <label for="asignatura_id" class="form-label">Asignatura : <span class="text-red">*</span></label>
                                    <select class="form-control select2 form-select" name="asignatura_id" id="asignatura_id" data-placeholder="Seleccione..." required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($asignatura as $item)
                                            <option value="{{ $item->id }}"
                                                {{ ( ($aula && $aula->asignatura_id==$item->id) ? 'selected' : null) }}
                                                >{{ $item->nombre }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group select2-sm">
                                    <label for="curso_id" class="form-label">Cursos : <span class="text-red">*</span></label>
                                    <select class="form-control select2 form-select" name="curso_id" id="curso_id" data-placeholder="Seleccionee.." required>
                                        @if ($aula)
                                            @foreach ($cursos as $item)
                                                <option value="{{ $item->id }}" {{ ( ($aula->curso_id==$item->id) ? 'selected' : null) }}>{{ $item->nombre }}</option>
                                            @endforeach
                                        @endif
                                        {{-- @foreach ($cursos as $item)
                                            <option value="{{ $item->id }}" {{ ( ($aula && $aula->curso_id==$item->id) ? 'selected' : null) }}>{{ $item->nombre }}</option>
                                        @endforeach --}}

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group select2-sm">
                                    <label for="docente_id" class="form-label">Docentes : <span class="text-red">*</span></label>
                                    <select class="form-control select2 form-select" name="docente_id" id="docente_id" data-placeholder="Seleccione.." required>
                                        <option value="" >Seleccione...</option>
                                        @foreach ($docentes as $item)
                                            <option value="{{ $item->usuario->id }}" {{ ( ($aula && $aula->docente_id == $item->usuario->id) ? 'selected' : null) }}>{{ $item->usuario->nombre_corto }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fecha" class="form-label">Fecha : <span class="text-red">*</span></label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" name="fecha" id="fecha" value="{{ ($aula ?date("d-m-Y", strtotime($aula->fecha)) : date('d-m-Y'))  }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="hora_inicio" class="form-label">Hora Inicio : <span class="text-red">*</span></label>
                                    <input type="time" name="hora_inicio" class="form-control form-control-sm text-center" id="hora_inicio" placeholder="Nombre...." value="{{ ($aula ? $aula->hora_inicio : null) }}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <label for="hora_final" class="form-label">Hora Final : <span class="text-red">*</span></label>
                                    <input type="time" name="hora_final" class="form-control form-control-sm text-center" id="hora_final" placeholder="Nombre...." value="{{ ($aula ? $aula->hora_final : null) }}"  required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="capacidad" class="form-label">Cantidad : <span class="text-red">*</span></label>
                                    <input type="number" name="capacidad" class="form-control form-control-sm text-center" id="capacidad" placeholder="Cantidad...." value="{{ ($aula ? $aula->capacidad : null) }}" title="Solo puede ingresar Números mallores a cero(0)" min="1" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mt-6">
                                    <label class="custom-switch form-switch mb-0">
                                        <input type="checkbox" name="abierto" class="custom-switch-input" value="1" {{ ($aula ? ($aula->abierto==1?'checked':'') : null) }}>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Abierto</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion" class="form-label">Descripción : </label>
                                    <textarea name="descripcion" class="form-control form-control-sm" id="descripcion" cols="30" rows="10">{{ ($aula ? $aula->descripcion : null) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-end">
                                <a href="{{ route('hb.academicos.aulas.lista') }}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                                <button class="btn btn-success btn-sm"><i class="fa fa-save"></i> Guardar</button>
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
    <script src="{{asset('template/js/select2.js')}}"></script>

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
                // language:'es',
                dateFormat: "dd-mm-yy"
            });
            // Select2 by showing the search
            // $('.select2-show-search').select2({
            //     minimumResultsForSearch: '',
            //     width: '100%'
            // });
            const view = new AulaView(new AulaModel(csrf_token));
            view.eventos();
        });



    </script>
@endsection
