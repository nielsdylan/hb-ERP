@extends('components.layouts.app')
@section('titulo')
HB GROUP - Mis Cursos
@endsection
@section('content')
<div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Mis Cursos</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Mis cursos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Curso</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="wideget-user mb-2">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="panel profile-cover">
                                        <div class="profile-cover__action bg-img"></div>
                                        <div class="profile-cover__img">
                                            {{-- <div class="profile-img-1">
                                                <img src="../assets/images/users/21.jpg" alt="img">
                                            </div> --}}
                                            <div class="profile-img-content text-dark text-start">
                                                <div class="text-dark">
                                                    <h3 class="h3 mb-2">{{ $aula->codigo }}</h3>
                                                    <h5 class="text-muted">{{ $aula->codigo }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-profile">
                                            <button class="btn btn-info btn-sm mt-1 mb-1"> <i class="fe fe-cast"></i> <span>Ingresar al aula</span></button>
                                            {{-- <button class="btn btn-secondary mt-1 mb-1"> <i class="fa fa-envelope"></i> <span>Volver</span></button> --}}
                                            <a href="{{ route('hb.mis-cursos.lista') }}" class="btn btn-danger btn-sm mt-1 mb-1"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="px-0 px-sm-4">
                                        <div class="social social-profile-buttons mt-5 float-end">
                                            <div class="mt-3">
                                                <a class="social-icon text-primary" href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-1 -->
    <div class="row">
        <div class="col-md-12">

        </div>


    </div>
    <!-- ROW-1 END -->

</div>
@endsection
