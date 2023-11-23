<section class="header">
    <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-none d-md-block" align="left">
                    <ul class="list-inline mb-0">
                            <a href="{{ route('inicio') }}" class="list-inline-item text-white"><i class="far fa-clock"></i>
                                Lunes a Viernes de 7:30 a.m - 5 p.m y sabados 7:30 a.m - 12 p.m
                            </a>
                    </ul>
                </div>

                <div class="col-md-6 d-none d-md-block" align="right">
                    <ul class="list-inline mb-0">
                        <a href="tel:+51 53 474805" class="list-inline-item text-white"><i class="fa fa-phone"></i> (+51) 53 474805</a>
                        <a href="https://wa.me/+51 932 777 533?text=" target="_blank" class="list-inline-item text-white"><i class="fab fa-whatsapp text-white"></i> (+51) 932 777 533</a>

                        {{-- <a href="https://www.facebook.com/HBgroup.pe" target="_blank" class="list-inline-item icon text-white"><i class="fab fa-facebook-f text-white"></i></a> --}}

                        <a href="https://site5.q10.com/login?ReturnUrl=%2F&aplentId=05554f9b-6439-4175-8443-321c9ebcf09d" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-user-graduate text-white"></i> Aula virtual</a>

                        {{-- <a href="{{route('autentication')}}" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-user-graduate text-white"></i> Autenticación</a> --}}

                        <a href="{{route('calendario')}}" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-calendar-alt text-white"></i> Cursos</a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12 d-block d-md-none pt-2" align="center">
            {{-- @if ($configurations->schedule) --}}
                <div class="col-md-12">
                    <a href="{{ url('/') }}" class="list-inline-item text-white"><i class="far fa-clock"></i> Lunes a Viernes de 7:30 a.m - 5 p.m y sabados 7:30 a.m - 12 p.m</a>
                </div>
            {{-- @endif --}}
            <ul class="list-inline mb-0">
                {{-- @if ($configurations->telephone) --}}
                <a href="tel:+51 53 474805" class="list-inline-item text-white"><i class="fa fa-phone"></i> (+51) 53 474805</a>
                {{-- @endif --}}
                {{-- @if ($configurations->mobile) --}}
                <a href="https://wa.me/932777533?text=" target="_blank" class="list-inline-item text-white"><i class="fab fa-whatsapp text-white"></i> (+51) 932 777 533</a>
                {{-- @endif --}}
                <a href="https://site5.q10.com/login?ReturnUrl=%2F&aplentId=05554f9b-6439-4175-8443-321c9ebcf09d" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-user-graduate text-white"></i> Aula virtual</a>
                {{-- <a href="{{route('autentication')}}" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-user-graduate text-white"></i> Aula virtual</a> --}}
                <a href="{{route('calendario')}}" target="_blank" class="list-inline-item icon text-white"><i class="fas fa-calendar-alt text-white"></i> Cursos</a>
            </ul>
        </div>
    </div>
</section>



<nav id="menu_navbar" class="navbar navbar-expand-lg navbar-light bg-light text-white bg-dark">
    <div class="container">
        <a class="navbar-brand d-none d-sm-none d-lg-block d-md-block text-white pt-2 pb-2" href="{{ url('/') }}">
            {{-- <span class="img-logo"></span><span class="pl-5 ml-3"> HB GROUP PERÚ</span> --}}
            <img src="{{asset('web/uploads/public/logo_snc.png')}}" class="img-footer"height="50"> HB GROUP PERÚ
        </a>

        <a class="navbar-brand d-block d-sm-block d-lg-none d-md-none text-white mr-0 ml-3" href="{{ url('/') }}">
            {{-- <span class="img-logo"></span> --}}
            <img src="{{asset('web/uploads/public/logo_snc.png')}}" class="img-footer"height="50">
            {{-- <img src="{{asset('uploads/public/logo_snc.png')}}" height="50"> --}}
        </a>
        <button class="navbar-toggler mr-4 " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item {{ request()->routeIs('inicio') ? 'active' : '' }}">
                    <a class="nav-link hb-active text-white" href="{{ url('/') }}">INICIO <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ request()->routeIs('nosotros') ? 'active' : '' }}">
                    <a class="nav-link hb-active text-white" href="{{ url('/nosotros') }}">NOSOTROS</a>
                </li>
                <li class="nav-item {{ request()->routeIs('servicios') ? 'active' : '' }}">
                    <a class="nav-link hb-active text-white" href="{{ url('/servicios') }}">SERVICIOS</a>
                </li>
                <li class="nav-item {{ request()->routeIs('contacto') ? 'active' : '' }}">
                    <a class="nav-link hb-active text-white" href="{{ url('/contacto') }}">CONTACTO</a>
                </li>
                <li class="nav-item @yield('active_menu') d-none d-sm-none d-lg-block d-md-block">
                    <a class="nav-link hb-active text-white " href="#">MÁS OPCIONES</a>
                    <ul >
                        <li>
                            <a class="nav-link text-white" href="{{route('certificado')}}">CERTIFICADOS</a>
                        </li>
                        <li>
                            <a class="nav-link text-white" href="{{route('calendario')}}">CALENDARIO</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @yield('active_menu') d-block d-sm-block d-lg-none d-md-none">
                    <a class="nav-link text-white" data-toggle="collapse" href="#option" role="button" aria-expanded="false" aria-controls="collapseExample">
                        MÁS OPCIONES
                    </a>
                    <div class="collapse" id="option">
                        <div class="card card-body hb-bg-blue p-0">
                            <ul class="hb-list-block">
                                <li><a class="nav-link text-white " href="{{route('certificado')}}">CERTIFICADOS</a></li>
                                <li><a class="nav-link text-white " href="{{route('calendario')}}">CALENDARIO</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

