<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Niels Dylan Quispe Peralta.">
    <meta name="keywords" content="HB Group Perú">

    <script src="{{asset('web/assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: {"families":["Open+Sans:300,400,600,700"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ["{{asset('web/assets/css/fonts.css')}}"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{asset('web/assets/css/frontend/menu.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/frontend/frontend.css')}}">
    <link href="{{asset('web/assets/css/frontend/owl.carousel.css')}} " rel="stylesheet">
    <link rel="stylesheet" href="{{asset('web/assets/css/frontend/animate.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/frontend/bootstrap.min.css')}}">
    <link href="{{asset('web/assets/js/plugin/fancybox/jquery.fancybox.css?v=2.1.5')}}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{asset('web/assets/css/owlcarousel/owlcarousel/assets/owl.carousel.min.css')}} " rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{asset('web/assets/js/js/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" />
    <link href="{{asset('web/assets/calendar/css/fullcalendar.css')}}" rel='stylesheet' />
    <link href="{{asset('web/assets/css/calendar.css')}}" rel='stylesheet' />

    <link rel="icon" href="{{asset('web/uploads/public/logo_snc.png')}}" type="image/x-icon">
    <title>@yield('title')</title>
</head>
<body class="hidden">

    {{-- header --}}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @include('web.layouts.header')
    @include('web.layouts.menu')
    {{-- nav --}}

    @yield('content')
    {{-- footer --}}
    @include('web.layouts.footer')

    {{-- scrip --}}
    <script src="{{asset('web/assets/js/plugin/fancybox/jquery.fancybox.js')}}"></script>
    <script src="{{asset('web/assets/js/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('web/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
    <script src="{{asset('web/assets/js/js/owl.carousel.js')}}"></script>
    <script src="{{asset('web/assets/js/js/wow.js')}}"></script>
    <script src="{{asset('web/assets/js/plugin/fancybox/jquery.fancybox.js?v=2.1.6')}}" type="text/javascript"></script>
    <script src="{{asset('web/assets/js/plugin/select2/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('web/assets/js/frontend.js')}}"></script>
    <script src="{{asset('web/assets/calendar/js/moment.min.js')}}"></script>
    <script src="{{asset('web/assets/calendar/js/fullcalendar/fullcalendar.min.js')}}"></script>
    <script src="{{asset('web/assets/calendar/js/fullcalendar/fullcalendar.js')}}"></script>
    <script src="{{asset('web/assets/calendar/js/fullcalendar/locale/es.js')}}"></script>
    @routes
    <script>
        const csrf_token = '{{ csrf_token() }}';
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    @yield('script')
</body>
</html>
