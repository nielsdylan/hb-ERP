@extends('web.layouts.app')
@section('title','HB Group Perú')
@section('content')
    <section id="offerts">
        <div class="container" id="card-services">
            <div class="row animated fadeInUp">
                <div class="col-md-12">
                    <h2 class="text-center">Soluciones en capacitación, entrenamiento y asesoramiento a la medida de tu organización</h2>
                    <h>Servicios que ofrecemos</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-card mt-5 mb-5 animated fadeInUp">
                        <div class="card-body card-color">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('web/uploads/public/seguridad.png')}}" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5>
                                        Cursos de Seguridad Portuaria
                                    </h5>
                                    <p>
                                        Cursos PBIP I, Seguridad Portuaria, Mercancías Peligrosas acorde a lo requerido por la Autoridad Portuaria Nacional (APN)
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-card  mt-5 mb-5 animated fadeInUp">
                        <div class="card-body card-color">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('web/uploads/public/maritima.png')}}" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5>
                                        Cursos en Seguridad Marítima
                                    </h5>
                                    <p>
                                        Formación y entrenamiento en técnicas de Supervivencia en el mar y rescate de hombre al agua, respaldados por PADI (Professional Association of Diving Instructors)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}

            {{-- <div class="row"> --}}
                <div class="col-md-6">
                    <div class="card border-card  mt-5 mb-5 services-view-card">
                        <div class="card-body card-color">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('web/uploads/public/minera.png')}}" alt="">
                                </div>
                                <div class="col-md-8 ">
                                    <h5>
                                        Cursos en Seguridad Minera
                                    </h5>
                                    <p>
                                        Realizamos la matriz de capacitación en base al Reglamento de Seguridad y Salud Ocupacional en Minería (D.S.-024-2016-EM y D.S.-0523-2017-EM)
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-card  mt-5 mb-5 services-view-card">
                        <div class="card-body card-color">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('web/uploads/public/emergencia.png')}}" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5>
                                        Formación en Respuesta a Emergencia
                                    </h5>
                                    <p>
                                        Formación y entrenamiento en Lucha Contra Incendios y Primeros Auxilios, bajo estándares NFPA y AHA. Respaldados por EFR (Emergenccy First Response de Estados Unidos).
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}


            {{-- <div class="row"> --}}
                <div class="col-md-6">
                    <div class="card border-card  mt-5 mb-5 services-view-card">
                        <div class="card-body card-color">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('web/uploads/public/calidad.png')}}" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5>
                                        Cursos en Gestión de Calidad
                                    </h5>
                                    <p>
                                        Formación en los requisitos de la ISO 9001:2015, elaboración de indicadores, redacción de No Conformidades y Acciones Correctivas, entre otras.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-card  mt-5 mb-5 services-view-card">
                        <div class="card-body card-color">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('web/uploads/public/ambiental.png')}}" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5>
                                        Cursos en Gestión Ambiental
                                    </h5>
                                    <p>
                                        Formación en los aspectos e impactos ambientales y medidas de control, gestión de residuos sólidos, y otros en base a normativa nacional e internacional (ISO 14001:2015).
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}

            {{-- <div class="row"> --}}
                <div class="col-md-6">
                    <div class="card border-card  mt-5 mb-5 services-view-card">
                        <div class="card-body card-color">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('web/uploads/public/proteccion.png')}}" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5>
                                        Cursos en Gestión de Protección
                                    </h5>
                                    <p>
                                        Formación e instrucción sobre las amenazas actuales, prevención del narcotráfico, controles y estándares de protección y seguridad física (security), bajo normas BASC, ISO 28000, ISPS/PBIP, entre otras.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-card  mt-5 mb-5 services-view-card">
                        <div class="card-body card-color">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('web/uploads/public/otros.png')}}" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5>
                                        Otros servicios
                                    </h5>
                                    <p>
                                        Tenemos una gama de soluciones en capacitación y asesoría que podemos ofrecerles, contáctennos para brindarles una propuesta adecuada a sus necesidades.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        window.onscroll = function() {
            var scroll = window.scrollY;

            var services_view_card = $('.services-view-card');
            console.log(services_view_card);
            $.each(services_view_card, function (index, element) {
                if ((scroll+500)>=($(element).offset().top)) {
                    $(element).addClass('animated fadeInUp');

                }
            });
            var pre_footer = $('#footer .pre-footer').offset().top;
            if ((scroll+700)>=pre_footer) {
                $('#footer .pre-footer').addClass('animated fadeInUp');

            }
            var footer_copy = $('#footer .footer-copy').offset().top;
            console.log(scroll);
            console.log(footer_copy);
            if ((scroll+700)>=footer_copy) {
                $('#footer .footer-copy').addClass('animated fadeInUp');

            }
        };
    </script>

@endsection