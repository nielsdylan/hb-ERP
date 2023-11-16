<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HB Group</title>
    <link rel="stylesheet" href="{{ asset('web/plugins/bootstrap/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('web/plugins/swiper/css/swiper.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('web/plugins/swiper/css/swiper-bundle.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('web/plugins/swiper/css/index.e309a75a.css') }}"> --}}
    <style>
        html,
        body {
          position: relative;
          height: 100%;
        }
    
        body {
          background: #eee;
          font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
          font-size: 14px;
          color: #000;
          margin: 0;
          padding: 0;
        }
    
        .swiper {
          width: 100%;
          height: 100%;
        }
    
        .swiper-slide {
          text-align: center;
          font-size: 18px;
          background: #fff;
          display: flex;
          justify-content: center;
          align-items: center;
        }
    
        .swiper-slide img {
          display: block;
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
    
        .swiper {
          margin-left: auto;
          margin-right: auto;
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

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">1</div>
            <div class="swiper-slide">2</div>
            <div class="swiper-slide">Slide 3</div>
            <div class="swiper-slide">Slide 4</div>
            <div class="swiper-slide">Slide 5</div>
            <div class="swiper-slide">Slide 6</div>
            <div class="swiper-slide">Slide 7</div>
            <div class="swiper-slide">Slide 8</div>
            <div class="swiper-slide">Slide 9</div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

    <script src="{{ asset('web/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    {{-- <script type="module" crossorigin src="{{ asset('web/plugins/swiper/js/swiper.min.js') }}"></script> --}}
    <script type="module" crossorigin src="{{ asset('web/plugins/swiper/js/swiper-bundle.min.js') }}"></script>
    {{-- <script type="module" crossorigin src="{{ asset('web/plugins/swiper/js/index.53cd5dcf.js') }}"></script> --}}
    {{-- <script rel="modulepreload" href="{{ asset('web/plugins/swiper/js/vendor.d37b315a.js') }}"></script> --}}
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
         // now we need to assign all parameters to Swiper element
  Object.assign(swiperEl, swiperParams);

// and now initialize it
swiperEl.initialize();
    </script>
</body>
