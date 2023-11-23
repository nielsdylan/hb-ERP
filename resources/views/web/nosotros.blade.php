@extends('web.layouts.app')
@section('title','HB Group Perú')
@section('content')
    <section id="us">
        <div class="container">
            <div class="row">
                <div class="col-md-12 animated fadeInUp">
                    <p>&nbsp;</p>
                    <h1>
                        NOSOTROS
                    </h1>
                    <p>&nbsp;</p>
                </div>
            </div>
            <div class="row pb-5">
                <div class="col-md-12 text-justify text-font animated fadeInUp">
                    <p>
                        Somos una empresa peruana, con base en el puerto de Ilo en Moquegua. Buscamos convertirnos en la principal empresa de capacitación, entrenamiento y asesoramiento empresarial en el sur del Perú.
                        Nos involucramos con los objetivos y problemas de nuestros clientes brindando soluciones a la medida a través de capacitación en gestión de seguridad, ambiental, protección, calidad así como en asesoramiento en gestión empresarial.
                        Brindamos servicios de calidad con alto nivel técnico y profesional enfocándonos en la satisfacción de nuestros clientes, y por ello nos encontramos en constante análisis y mejora de nuestros procesos.
                        Confía en nosotros y nos convertiremos en un gran elemento de soporte para tu organización.
                    </p>
                </div>
            </div>

            <div class="row pb-5">
                <div class="col-md-6 animated fadeInUp">
                    <img src="{{asset('web/uploads/public/jefe_hb.png')}}" class="img-us">
                    {{-- <div class="img-hb-groupp-peru d-none d-sm-none d-lg-block d-md-block"> --}}

                    {{-- </div> --}}
                    {{-- <div class="img-hb-groupp-peru-mobile d-block d-sm-block d-lg-none d-md-none mb-5"> --}}

                    {{-- </div> --}}
                </div>
                <div class="col-md-6">
                    <div class="row pb-5">
                        <div class="col-md-12 animated fadeInUp">
                            <h2 class="text-center">Misión:</h2>
                            <p class="text-justify text-font-size">"Contribuimos al logro de los objetivos de nuestros clientes, brindando soluciones a la medida en capacitación en gestión de seguridad, ambiental, protección, calidad y asesoramiento en gestión empresarial"
                            </p>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-md-12 vision-us">
                            <h2 class="text-center ">Visión:</h2>
                            <p class="text-justify text-font-size">"Ser la principal empresa de capacitación, entrenamiento y asesoramiento empresarial en el sur del Perú"
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row pb-5">
                <div class="col-md-12 ">
                    <div class="row profile-ordenador">
                        <div class="col-md-6 d-none d-sm-none d-lg-block d-md-block text-right pt-4">
                            <a class="profile-circle" >
                            </a>
                        </div>
                        <div class="col-md-6 d-none d-sm-none d-lg-block d-md-block">
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <h4>MBA Helard Bejarano</h4>
                            <h4>CEO - HB GROUP PERU</h4>
                        </div>
                    </div>


                    <div class="row profile-mobile">
                        <div class="col-md-6 pb-5 text-center d-block d-sm-block d-lg-none d-md-none">
                            <a class="profile-circle-mobile" >
                            </a>
                        </div>
                        <div class="col-md-6 d-block d-sm-block d-lg-none d-md-none text-center">
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <h4>MBA Helard Bejarano</h4>
                            <h4>CEO - HB GROUP PERU</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section id="sliders">
        <div class="container">

            <div class="row img-carousel-us">
                <div class="col-md-12">
                    <div class="slider_card owl-carousel">
                        <div class="img-content-two">
                            <div class="card border-card">
                                <div class="card-body card-slider">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/slider/us_img_sl2_1.jpg')}}">
                                    <div class="card-box" style="
                                        background: url('{{asset('web/uploads/slider/us_img_sl2_1.jpg')}}');
                                        background-size: cover;
                                        background-position: center;
                                        background-repeat: no-repeat;
                                        border: 0px solid #8e8b8b;
                                        padding-bottom: 250px;
                                        padding-left: 240px;
                                        border-radius: 10px;"
                                    ></div></a>
                                </div>
                            </div>
                        </div>
                        <div class="img-content">
                            <div class="card border-card">
                                <div class="card-body card-slider">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/slider/us_img_sl2_2.jpg')}}">
                                    <div class="card-box" style="
                                        background: url('{{asset('web/uploads/slider/us_img_sl2_2.jpg')}}');
                                        background-size: cover;
                                        background-position: center;
                                        background-repeat: no-repeat;
                                        border: 1px solid #8e8b8b;
                                        padding-bottom: 250px;
                                        padding-left: 240px;
                                        border-radius: 10px;"
                                    ></div></a>
                                </div>
                            </div>

                        </div>
                        <div class="img-content">
                            <div class="card border-card">
                                <div class="card-body card-slider">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/slider/us_img_sl2_3.jpg')}}">
                                    <div class="card-box" style="
                                        background: url('{{asset('web/uploads/slider/us_img_sl2_3.jpg')}}');
                                        background-size: cover;
                                        background-position: center;
                                        background-repeat: no-repeat;
                                        border: 1px solid #8e8b8b;
                                        padding-bottom: 250px;
                                        padding-left: 240px;
                                        border-radius: 10px;"
                                    ></div></a>
                                </div>
                            </div>

                        </div>
                        <div class="img-content">
                            <div class="card border-card">
                                <div class="card-body card-slider">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/slider/us_img_sl2_4.jpg')}}">
                                    <div class="card-box" style="
                                        background: url('{{asset('web/uploads/slider/us_img_sl2_4.jpg')}}');
                                        background-size: cover;
                                        background-position: center;
                                        background-repeat: no-repeat;
                                        border: 1px solid #8e8b8b;
                                        padding-bottom: 250px;
                                        padding-left: 240px;
                                        border-radius: 10px;"
                                    ></div></a>
                                </div>
                            </div>

                        </div>
                        <div class="img-content">
                            <div class="card border-card">
                                <div class="card-body card-slider">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/slider/us_img_sl2_5.jpg')}}">
                                    <div class="card-box" style="
                                        background: url('{{asset('web/uploads/slider/us_img_sl2_5.jpg')}}');
                                        background-size: cover;
                                        background-position: center;
                                        background-repeat: no-repeat;
                                        border: 1px solid #8e8b8b;
                                        padding-bottom: 250px;
                                        padding-left: 240px;
                                        border-radius: 10px;"
                                    ></div></a>
                                </div>
                            </div>

                        </div>
                        <div class="img-content">
                            <div class="card border-card">
                                <div class="card-body card-slider">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/slider/us_img_sl2_6.jpg')}}">
                                    <div class="card-box" style="
                                        background: url('{{asset('web/uploads/slider/us_img_sl2_6.jpg')}}');
                                        background-size: cover;
                                        background-position: center;
                                        background-repeat: no-repeat;
                                        border: 1px solid #8e8b8b;
                                        padding-bottom: 250px;
                                        padding-left: 240px;
                                        border-radius: 10px;"
                                    ></div></a>
                                </div>
                            </div>

                        </div>
                        <div class="img-content">
                            <div class="card border-card">
                                <div class="card-body card-slider">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/slider/us_img_sl2_7.jpg')}}">
                                    <div class="card-box" style="
                                        background: url('{{asset('web/uploads/slider/us_img_sl2_7.jpg')}}');
                                        background-size: cover;
                                        background-position: center;
                                        background-repeat: no-repeat;
                                        border: 1px solid #8e8b8b;
                                        padding-bottom: 250px;
                                        padding-left: 240px;

                                        border-radius: 10px;"
                                    ></div></a>
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


            var imr_carousel_us = $('.img-carousel-us').offset().top;
            if ((scroll+500)>=imr_carousel_us) {
                $('.img-carousel-us').addClass('animated fadeInUp');

            }

            var profile_ordenador = $('.profile-ordenador').offset().top;
            if ((scroll+500)>=profile_ordenador) {
                $('.profile-ordenador').addClass('animated fadeInUp');

            }
            var profile_mobile = $('.profile-mobile').offset().top;
            if ((scroll+500)>=profile_mobile) {
                $('.profile-mobile').addClass('animated fadeInUp');

            }

            var vision_us = $('.vision-us').offset().top;
            if ((scroll+500)>=vision_us) {
                $('.vision-us').addClass('animated fadeInUp');

            }
            var pre_footer = $('#footer .pre-footer').offset().top;
            if ((scroll+700)>=pre_footer) {
                $('#footer .pre-footer').addClass('animated fadeInUp');

            }
            var footer_copy = $('#footer .footer-copy').offset().top;

            if ((scroll+800)>=footer_copy) {
                $('#footer .footer-copy').addClass('animated fadeInUp');

            }
        };

    </script>

@endsection