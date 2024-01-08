@extends('components.layouts.app')
@section('titulo')
HB GROUP - Gestion de Aulas
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
        <h1 class="page-title">Gestion de Aulas</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Academico</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gestion de Aulas</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    @if (in_array(16,$array_accesos))
    <div class="row mb-3">
        <div class="col-md-12 text-end">
            @if (in_array(17,$array_accesos))
            <button type="button" id="nuevo" class="btn btn-success"><i class="fa fa-plus"></i> Nueva Aula</button>
            @endif
        </div>
    </div>
    <div class="row">
        @foreach ($aulas as $item)
        <div class="col-md-3">

            <div class="card">
                <div class="card-body text-center">
                    <div class="media-body pt-0">
                        <div class="float-md-end d-flex fs-15">
                            {{-- <a href="javascript:void(0)"><i class="mdi mdi-dots-vertical"></i></a> --}}
                            {{-- <div class="dropdown"> --}}
                                <a class="nav-link float-end  pe-0 pt-0" href="javascript:void(0)" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    @if (in_array(18,$array_accesos))
                                    <a class="dropdown-item editar" href="javascript:void(0)" data-id="{{ $item->id }}"><i class="fe fe-edit me-1 d-inline-flex"></i> Editar Aula</a>
                                    @endif
                                    @if (in_array(19,$array_accesos))
                                    <a class="dropdown-item eliminar" href="javascript:void(0)" data-id="{{ $item->id }}"><i class="fe fe-trash-2 me-1 d-inline-flex"></i> Eliminar Aula</a>
                                    @endif
                                </div>
                            {{-- </div> --}}
                        </div>
                    </div>

                    <i class="fa fa-graduation-cap text-info fa-3x"></i>
                    <h6 class="mt-4 mb-2">{{ $item->codigo }}</h6>
                    {{-- <h2 class="mb-2  number-font">{{ $item->capacidad }}</h2> --}}
                    {{-- <p class="text-muted">{{ $item->descripcion }}</p> --}}
                    <div class="d-grid gap-2">
                        <button class="btn btn-sm btn-pill btn-success-light unirse-sala" data-id="{{ $item->id }}">Aula virtual</button>
                        {{-- @if (in_array(20,$array_accesos))
                        <button class="btn btn-sm btn-pill btn-info-light asistencia" data-id="{{ $item->id }}">Asistencia</button>
                        @endif
                        @if (in_array(21,$array_accesos))
                        <button class="btn btn-sm btn-pill btn-warning-light agregar-participantes" data-id="{{ $item->id }}">Agregar alumnos</button>
                        @endif --}}
                        <a href="{{ route('hb.academicos.aulas.portafolio', ['id'=>$item->id]) }}" class="btn btn-sm btn-pill btn-defaul-light"">Portafolio</a>
                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-2">
            {{ $aulas->links() }}
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


</div>
@endsection

@section('script')

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{asset('template/plugins/select2/select2.full.min.js')}}"></script>
    {{-- <script src="{{asset('template/js/select2.js')}}"></script> --}}

    <script src="{{asset('components/academico/aulas/aula-model.js')}}"></script>
    <script src="{{asset('components/academico/aulas/aula-view.js')}}"></script>
    <script>
        $(document).ready(function () {
            const view = new AulaView(new AulaModel(csrf_token));
            view.eventos();
        });
    </script>
@endsection
