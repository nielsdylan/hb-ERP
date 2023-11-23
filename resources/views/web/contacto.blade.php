@extends('web.layouts.app')
@section('title','HB Group Perú')
@section('content')
    <section id="contact-two">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 animated fadeInUp">
                    <p>&nbsp;</p>
                    <h1>Contáctenos</h1>
                    <h3>Para darle una solución a la medida</h3>
                </div>
            </div>
            <div class="row ">

                <div class="col-md-5 animated fadeInUp">
                    <p>&nbsp;</p>
                    {{-- @if ($configurations->email) --}}
                        <h4>Correo de contacto</h4>
                        <ul class="list-unstyled-contac">
                            <li>
                                <a href="mailto:comercial@hbgroup.pe?Subject=Consulta%20de%20su%20servicio&body=Con%20urgencia" class="email-contact"><i class="far fa-envelope"></i> &nbsp;comercial@hbgroup.pe</a>
                            </li>

                        </ul>
                    {{-- @endif
                    @if ($configurations->telephone || $configurations->mobile) --}}
                        <h4>Números de contacto</h4>
                        <ul class="list-unstyled">
                            {{-- @if ($configurations->mobile) --}}
                            <li>
                                <i class="fa fa-mobile-alt"></i> &nbsp;&nbsp;(+51) 932 777 533
                            </li>
                            {{-- @endif
                            @if ($configurations->telephone) --}}
                            <li>
                                <i class="fa fa-phone"></i> &nbsp;(+51) 53 474805
                            </li>
                            {{-- @endif --}}

                        </ul>
                    {{-- @endif
                    @if ($configurations->facebook || $configurations->linkedin) --}}
                    <h4>Síguenos</h4>
                    <ul class="list-unstyled">
                        {{-- @if ($configurations->facebook) --}}
                        <a href="https://www.facebook.com/HBgroup.pe" target="_blank"><i class="fab fa-facebook pr-2 pl-2"></i>
                        </a>
                        {{-- @endif
                        @if ($configurations->linkedin) --}}
                        <a href="https://www.linkedin.com/company/hbgroupperu/about/" target="_blank"><i class="fab fa-linkedin pr-2"></i></a>
                        {{-- @endif --}}

                    </ul>
                    {{-- @endif --}}
                    {{-- @if ($configurations->direction) --}}
                    <h4>Ubícanos</h4>
                    <ul class="list-unstyled">
                        <li>
                            <i class="fas fa-map-marker-alt contact"></i><span> &nbsp;Nueva Victoria Mz 04 Lote 16 Ilo, Moquegua, Perú 18601</span>
                        </li>

                    </ul>
                    {{-- @endif --}}
                </div>
                <div class="col-md-7">
                    <p>&nbsp;</p>
                    <form action="" id="form-contact" method="POST">
                        @csrf
                        {{-- @if (session('info'))
                            <div class="row animated fadeInUp">
                                <div class="col-md-12">
                                    <div class="alert alert-success" role="alert">
                                        {{session('info')}}
                                    </div>
                                </div>
                            </div>
                        @endif --}}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="my-input" class="form-control" type="text" placeholder="Nombres..." name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="my-input" class="form-control" type="text" placeholder="Apellidos..." name="last_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="my-input" class="form-control" type="email" placeholder="Email..." name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="my-input" class="form-control" type="number" placeholder="Telefono..." name="telephone" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea id="my-textarea" class="form-control" name=" message" rows="5"  placeholder="Mensaje..." required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <p>&nbsp;</p>
        </div>

    </section>
    <section id="map-gps">
        <div style="overflow:hidden;max-width:100%;width:100%;height:400px;">
            <div id="googlemaps-display" style="height:100%; width:100%;max-width:100%;">
                {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3801.868826203472!2d-71.3256665851199!3d-17.656370687917946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTfCsDM5JzIyLjkiUyA3McKwMTknMjQuNSJX!5e0!3m2!1ses!2spe!4v1619019370458!5m2!1ses!2spe" style="height:100%;width:100%;border:0;" allowfullscreen="" loading="lazy">
                </iframe> --}}
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3801.8677661772545!2d-71.3256346855188!3d-17.65642087619746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91445bcfd4f05ab1%3A0x3477887f664b4e1d!2sHB%20Group%20Per%C3%BA!5e0!3m2!1ses-419!2spe!4v1626123103607!5m2!1ses-419!2spe" style="height:100%;width:100%;border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>
    <script>
        window.onscroll = function() {
            var scroll = window.scrollY;


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