<div class="chatbox d-none d-sm-none d-lg-block d-md-block" data-close="chat-bot">
    <div class="row display-none-item">
        <div class="col-md-12">
            <div class="chat-header">
                <div class="row">
                    <div class="col-md-3">
                        <img src='{{asset('web/uploads/public/img-Alexa.png')}}' class='img-alexa mt-2 ml-2'/>
                    </div>
                    <div class="col-md-7 text-left pt-2">
                        <h2>Alexa</h2>
                        <span class="text-font-asisten">Asistente de HB Group Perú</span>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-link pl-2" data-action="close-chat-bot"><i class="fa fa-times text-white"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row display-none-item">
        <div class="col-md-12">
            <div class="body chat-body" id="chatbody">
                <div class="ms-alexa">
                    <img src='{{asset('web/uploads/public/img-Alexa.png')}}' class='img-alexa-chat '/>
                    <div class="alexa">
                        Hola mi nombre es Alexa, ¿Cuál es su consulta?
                    </div>
                </div>
                <div class="scroller"></div>
            </div>
        </div>
    </div>
    <div class="row display-none-item">
        <div class="col-md-12">
            <div class="chat-footer">
                <form class="chat" data-action="chat-box" method="post" action="" autocomplete="off">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control input-chat-bot" placeholder="Escriba..." name="chat" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-light btn-chat-bot" type="submit" ><i class="far fa-paper-plane text-dark"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<div class="chatbox-movil d-block d-sm-block d-lg-none d-md-none" data-close="chat-bot-movil">

    <div class="chat-header display-none-item mb-3">
        <div class="d-flex flex-row bd-highlight">
            <div class="bd-highlight">
                <img src='{{asset('web/uploads/public/img-Alexa.png')}}' class='img-alexa-movil mt-1'/>
            </div>
            <div class="p-2 bd-highlight">
                <h5>Alexa</h5>
                <span class="text-font-asisten-movil">Asistente de HB Group Perú</span>
            </div>
            <button class="btn btn-link pl-2 mb-auto " data-action="close-chat-bot"><i class="fa fa-times text-white"></i> </button>
        </div>


        {{-- <div class="p-2 bd-highlight"><button class="btn btn-link pl-2"><i class="fa fa-times text-white"></i> </button></div> --}}
    </div>


    <div class="body chat-body-movil display-none-item" id="chatbody">
        <div class="ms-alexa">
            <img src='{{asset('web/uploads/public/img-Alexa.png')}}' class='img-alexa-chat '/>
            <div class="alexa">
                Hola mi nombre es Alexa, ¿Cuál es su consulta?
            </div>
        </div>
        <div class="scroller-movil"></div>
    </div>
    <div class="chat-footer display-none-item">
        <form class="chat" data-action="chat-box-movil" method="post" action="" autocomplete="off">
            <div class="input-group mb-3">
                <input type="text" class="form-control input-chat-bot" placeholder="Escriba..." name="chat" required>
                <div class="input-group-append">
                <button class="btn btn-outline-light btn-chat-bot" type="submit" ><i class="far fa-paper-plane text-dark"></i></button>
                </div>
            </div>
        </form>
    </div>



</div>


{{-- <a href="#" class="img-bot" data-action="open-chat">
    <img src="{{asset('web/uploads/public/iconBOT.png')}}" class="btn-hb-bot hb-bot-hover">
    <div class="btn-hb-msg-bot display-none-item">Hola, ¿Te puedo ayudar en algo?</div>
</a> --}}
<a href="https://wa.me/+51946877806?text=Mi consulta es..." target="_blank" id="whatsapp-floot" class="btn-whatsapp-link d-none"><i class="fab fa-whatsapp"></i></a>
<a href="#" id="back-to-top" class="btn btn-lg btn-back-top"><i class="fa fa-angle-up"></i></a>
<section id="footer">
    <div class="pre-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{asset('web/uploads/public/logo_snc.png')}}" width="140" class="img-footer">
                        </div>
                        <div class="col-md-12 pt-3 text-center">
                            <h3> <strong>HB Group Perú</strong></h3>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 ">
                    <h6 class="text-white ">SITIO</h6>
                    <ul class="list-unstyled color-list">
                        <li>
                            <a href="{{ route('inicio') }}" class="text-footer"><i class="fa fa-angle-right"></i> INICIO</a>
                        </li>
                        <li>
                            <a href="{{ route('nosotros') }}" class="text-footer"><i class="fa fa-angle-right"></i> NOSOTROS</a>
                        </li>

                        <li>
                            <a href="{{ route('servicios') }}" class="text-footer"><i class="fa fa-angle-right"></i> SERVICIOS</a>
                        </li>

                        <li>
                            <a href="{{ route('contacto') }}" class="text-footer"><i class="fa fa-angle-right"></i> Contacto</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="text-white">CONTACTO</h6>
                    <ul class="list-unstyled color-list">
                        <li>
                            <ul class="list-unstyled">
                                {{-- @if ($configurations->direction) --}}
                                    <li><span class="text-footer"><i class="fas fa-map-marker-alt text-footer"></i> Nueva Victoria Mz 04 Lote 16 Ilo, Moquegua, Perú 18601</span></li>
                                {{-- @endif
                                @if ($configurations->mobile) --}}
                                    <li><span class="text-footer"><i class="fab fa-whatsapp text-footer"></i> (+51) 932 777 533</span></li>
                                {{-- @endif
                                @if ($configurations->telephone) --}}
                                    <li><span class="text-footer"><i class="fa fa-phone text-footer"></i> (+51) 53 474805</span></li>
                                {{-- @endif
                                @if ($configurations->email) --}}
                                    <li><span class="text-footer"><i class="fa fa-envelope text-footer"></i> comercial@hbgroup.pe</span></li>
                                {{-- @endif --}}

                            </ul>
                        </li>
                    </ul>
                    <div id="redes" >
                        <ul class="list-inline ml-5 d-none d-sm-none d-lg-block d-md-block">
                            <li class="list-inline-item">
                                {{-- @if ($configurations->facebook) --}}
                                <a class="facebook pr-3 text-white" href="https://www.facebook.com/HBgroup.pe" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                {{-- @endif
                                @if ($configurations->linkedin) --}}
                                <a class="text-white" href="https://www.linkedin.com/company/hbgroupperu/about/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                {{-- @endif --}}
                            </li>
                        </ul>
                        <ul class="list-inline text-center d-block d-sm-block d-lg-none d-md-none">
                            <li class="list-inline-item">
                                {{-- @if ($configurations->facebook) --}}
                                <a class="facebook pr-3 text-white" href="https://www.facebook.com/HBgroup.pe" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                {{-- @endif
                                @if ($configurations->linkedin) --}}
                                <a href="https://www.linkedin.com/company/hbgroupperu/about/" class="text-white" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                {{-- @endif --}}
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-copy">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 copyright_text wow fadeInUp animated">
                    <div class="d-none d-lg-block text-white">
                        <center><span>&copy; {{ date("Y") }} HBGroupp - Todos los derechos reservados. </center>
                    </div>
                    <div class="d-block d-lg-none text-white">
                        <center><span>&copy; {{ date("Y") }}  HBGroupp - Todos los derechos reservados.</span></center>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
