<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HB Group</title>
    <link rel="stylesheet" href="{{ asset('web/plugins/bootstrap5/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/plugins/swiper/css/swiper.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('web/plugins/swiper/css/swiper-bundle.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('web/plugins/swiper/css/index.e309a75a.css') }}"> --}}
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />

    <style>
        .swiper {
            width: 600px;
            height: 300px;
        }
    </style>
</head>

<body>
    {{-- <div id="app">
        <!-- Slicer slider -->
        <div class="swiper" >
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <!-- slicer image must have "swiper-slicer-image" class, one image per slide -->
                    <img class="swiper-slicer-image" src="{{ asset('web/images/sliders/slider_1.jpg') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img class="swiper-slicer-image" src="{{ asset('web/images/sliders/slider_2.jpg') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img class="swiper-slicer-image" src="{{ asset('web/images/sliders/slider_3.jpg') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img class="swiper-slicer-image" src="{{ asset('web/images/sliders/slider_1.jpg') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img class="swiper-slicer-image" src="{{ asset('web/images/sliders/slider_2.jpg') }}" alt="">
                </div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

    </div> --}}

    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">Slide 1</div>
          <div class="swiper-slide">Slide 2</div>
          <div class="swiper-slide">Slide 3</div>
          ...
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        <div class="swiper-scrollbar"></div>
    </div>

    <script src="{{ asset('web/plugins/bootstrap5/js/bootstrap.min.js') }}"></script>

    <script type="module" src="{{ asset('web/plugins/swiper/js/swiper.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> --}}
    {{-- <script type="module" src="{{ asset('web/plugins/swiper/js/swiper-bundle.min.js') }}"></script> --}}
    {{-- <script type="module" crossorigin src="{{ asset('web/plugins/swiper/js/index.53cd5dcf.js') }}"></script> --}}
    {{-- <script rel="modulepreload" href="{{ asset('web/plugins/swiper/js/vendor.d37b315a.js') }}"></script> --}}
    <script type="module">
    import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.mjs'
    const swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'vertical',
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
    });
    </script>
</body>
