@extends('web.layouts.app')
@section('title','HB Group Perú')
@section('active_menu','active')
@section('content')
    <section id="certificate-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center animated slideInUp">
                    <h4>Certificados</h4>
                </div>
            </div>
            <div class="row d-none d-sm-none d-lg-block d-md-block animated slideInUp">
                <div class="col-md-6 offset-3  text-justify">
                    {{-- <p>La empresa HB GROUP PERÚ S.R.L. brindar servicios de calidad, pone a disposición, el siguiente formulario en el cual pueden descargar los certificados correspondientes.</p> --}}
                    <p>
                        Los certificados de los cursos portuarios son emitidos por la AUTORIDAD PORTUARIA NACIONAL (APN), puedes descargarlos colocando tu DNI en el siguiente enlace
                    </p>
                    <p class="text-center">
                        <a href="https://cursos.apn.gob.pe/cursos/certificado/consulta-certificado" target="_blank" class="btn btn-danger">SISTEMA DE AUTORIDAD PORTUARIA</a>
                    </p>

                    <p>
                        Para otros cursos realizados por HB Group Perú puedes descargarlos aquí, ingresa tu número de documentó aquí:
                    </p>
                </div>
            </div>
            <div class="row d-block d-sm-block d-lg-none d-md-none animated slideInUp">
                <div class="col-md-12 text-justify">
                    {{-- <p>La empresa HB GROUP PERÚ S.R.L. brindar servicios de calidad, pone a disposición, el siguiente formulario en el cual pueden descargar los certificados correspondientes.</p> --}}
                    <p>
                        Los certificados de los cursos portuarios son emitidos por la AUTORIDAD PORTUARIA NACIONAL (APN), puedes descargarlos colocando tu DNI en el siguiente enlace
                    </p>
                    <p class="text-center">
                        <a href="https://cursos.apn.gob.pe/cursos/certificado/consulta-certificado" target="_blank" class="btn btn-danger">SISTEMA DE AUTORIDAD PORTUARIA</a>
                    </p>

                    <p>
                        Para otros cursos realizados por HB Group Perú puedes descargarlos aquí, ingresa tu número de documentó aquí:
                    </p>
                </div>
            </div>
            <div class="row d-none d-sm-none d-lg-block d-md-block ">
                <div class="col-md-6 offset-3 animated slideInUp">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" data-form="certi-send">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="dni">Ingrese su número de documento:</label>
                                            <input class="form-control" type="text" name="dni" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-certificate"></i> Verificar certificado</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-block d-sm-block d-lg-none d-md-none">
                <div class="col-md-12 animated slideInUp">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" data-form="certi-send">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="dni">Ingrese su número de documento:</label>
                                            <input class="form-control" type="text" name="dni" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-certificate"></i> Verificar certificado</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-none d-sm-none d-lg-block d-md-block">
                <div class="col-md-6 offset-3 mt-5 animated slideInUp">
                    <div class="card d-none" data-card="class-none">
                        <div class="card-body" data-table="table">

                        </div>
                    </div>

                </div>
            </div>
            <div class="row d-block d-sm-block d-lg-none d-md-none">
                <div class="col-md-12 mt-5 animated slideInUp">
                    <div class="card d-none" data-card="class-none">
                        <div class="card-body" data-table="table">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script>
        var data ={};
        $(document).ready(function () {
            // getPagination();
        });
    </script>
@endsection