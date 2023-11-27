@extends('web.layouts.app')
@section('title','HB Group Perú')
@section('content')

    @include('web.layouts.slider')
    <section id="services">
        <div class="container">
            <div class="row services-title">
                <div class="col-md-12">
                    <h1>Soluciones a la medida de tu organización</h1>
                    <h3>Conoce más sobre nuestros servicios</h3>
                </div>
            </div>
            <div class="row pt-5 ">
                <div class="col-md-4 pb-3">
                    <div class="card card-height border-card card-box services-card">

                        <div class="pt-3"  style="
                            background: url('{{asset('web/uploads/public/trainings.png')}}');
                            background-size: contain;
                            background-position: center;
                            background-repeat: no-repeat;
                            height: 150px;
                            margin-top: 20px;"
                        >

                        </div>
                        <div class="card-body text-center">
                            <h5>Capacitación </h5>
                            <p>Brindamos conocimientos en materia </p>
                            <p>de seguridad, ambiente, protección y</p>
                            <p>calidad.</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-3">
                    <div class="card card-height border-card card-box services-card">
                        <div style="
                            background: url('{{asset('web/uploads/public/training.png')}}');
                            background-size: contain;
                            background-position: center;
                            background-repeat: no-repeat;
                            height: 150px;
                            margin-top: 20px;"
                        ></div>
                        <div class="card-body text-center">
                            <h5>Entrenamiento </h5>
                            <p>Formamos habilidades y competencias</p>
                            <p>para realizar trabajos de alto riesgo.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-3">
                    <div class="card card-height border-card card-box services-card">
                        <div style="
                            background: url('{{asset('web/uploads/public/advice.png')}}');
                            background-size: contain;
                            background-position: center;
                            background-repeat: no-repeat;
                            height: 150px;
                            margin-top: 20px;"
                        ></div>
                        <div class="card-body text-center">
                            <h5>Asesoramiento </h5>
                            <p>Asesoramos en la elaboración de</p>
                            <p>documentación del Sistema de</p>
                            <p>Gestión según requerimientos legales</p>
                            <p>y normas internacionales.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-5 services-button">
                <div class="col-md-12 text-center">
                    <a href="{{ route('servicios') }}" class=" btn btn-light button-services"> Todos los Servicios</a>
                </div>
            </div>
        </div>
    </section>
    <section id="solution">

        <div class="row">
            <div class="col-md-12 text-center text-white d-none d-sm-none d-lg-block d-md-block">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <h1>Te ofrecemos soluciones a la medida</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center d-none d-sm-none d-lg-block d-md-block">
                <p>&nbsp;</p>
                <a class=" btn btn-light us" href="{{ route('contacto') }}"> Contactanos</a>
            </div>
        </div>


        <div class="row mr-0">
            <div class="col-md-12 text-center text-white d-block d-sm-block d-lg-none d-md-none">
                <p>&nbsp;</p>
                <h1>Te ofrecemos soluciones a la medida</h1>
            </div>
        </div>
        <div class="row mr-0">
            <div class="col-md-12 text-center d-block d-sm-block d-lg-none d-md-none">
                <p>&nbsp;</p>
                <a class=" btn btn-light us" href="{{ route('contacto') }}"> Contactanos</a>
            </div>
        </div>
    </section>
    <section id="business">
        <div class="container">
            <div class="row pb-5">
                <div class="col-md-12">
                    <h1>Empresas que confían en nosotros</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-thumbs mt-5">
                        <div class="owl-carousel-second">
                            {{-- @foreach ($business as $key=> $item ) --}}
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620223520.jpg')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620223520.jpg')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>

                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224001.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224001.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>

                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224028.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224028.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224044.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224044.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224059.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224059.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224070.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224070.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224083.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224083.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224107.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224107.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224121.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224121.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224138.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224138.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224151.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224151.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224166.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224166.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224176.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224176.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/1620224190.png')}}">
                                        <div style="background: url('{{asset('web/uploads/business/1620224190.png')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                                <div class="ficha_carousel_img" align="center">
                                    <a  class="fancybox" rel="galeria1" href="{{asset('web/uploads/business/dpw.jpg')}}">
                                        <div style="background: url('{{asset('web/uploads/business/dpw.jpg')}}');background-size: contain;background-position: center;background-repeat: no-repeat;height: 80px;max-width:  170px;"></div>
                                    </a>
                                </div>
                            {{-- @endforeach --}}
                        </div>
                        <a href="#" data-carousel="prev" class="owl-prev izquierda_ficha owl-carousel-product-left">
                        <i class="fa fa-angle-left" style="font-size: 14px; margin-left: 7px;"></i>
                        </a>
                        <a href="#" data-carousel="next" class="owl-next derecha_ficha owl-carousel-product-right">
                        <i class="fa fa-angle-right" style="font-size: 14px; margin-left: 8px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>

        window.onscroll = function() {
            var scroll = window.scrollY;

            var services_title = $('.row.services-title').offset().left;
            // var left_services = services_title.left;

            if (scroll>=(services_title/2)) {
                $('.services-title').addClass('animated fadeInUp');
                // console.log(left_services);
            }

            var card_services = $('.services-card');
            var car_1 = $(card_services[0]).offset().top;
            var car_2 = $(card_services[1]).offset().top;
            var car_3 = $(card_services[2]).offset().top;

            if ((scroll+300)>=car_1) {
                $(card_services[0]).addClass('animated fadeInUp');
            }
            if ((scroll+300)>=car_2) {
                $(card_services[1]).addClass('animated fadeInUp');
            }
            if ((scroll+300)>=car_2) {
                $(card_services[2]).addClass('animated fadeInUp');
            }

            var service_button = $('.services-button').offset().top;
            if ((scroll+500)>=service_button) {
                $('.services-button').addClass('animated fadeInUp');
            }

            var solution = $('#solution').offset().top;
            if ((scroll+300)>=service_button) {
                $('#solution').addClass('animated fadeInUp');

            }
            var business =  $('#business').offset().top;
            if ((scroll+300)>=business) {
                $('#business').addClass('animated fadeInUp');

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
