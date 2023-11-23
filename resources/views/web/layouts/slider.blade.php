<div id="slider" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
        {{-- @foreach ( $sliders as $key => $item ) --}}

            <div class="carousel-item active">
                <div class="img-fluid d-none d-md-block d-xl-block"  style="
                    background: url('{{asset('web/uploads/slider/slider_1.jpg')}}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    height: 550px;">
                </div>
                <div class="img-fluid d-none d-sm-block d-md-none"  style="
                    background: url('{{asset('web/uploads/slider/slider_2.jpg')}}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    height: 300px;">
                </div>
                <div class="img-fluid d-block d-sm-none"  style="
                    background: url('{{asset('web/uploads/slider/slider_3.jpg')}}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    height: 200px;">
                </div>

            </div>
        {{-- @endforeach --}}
    </div>
    <a class="carousel-control-prev" href="#slider" data-slide="prev">
        <span class="my-carousel-control-prev-icon"><i class="fas fa-chevron-left"></i></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slider" data-slide="next">
        <span class="my-carousel-control-next-icon"><i class="fas fa-chevron-right"></i></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="certificates-here d-lg-block d-md-none d-none d-sm-none" data-visible="visible">
    <h1 class="text-white">Revisa tus certificados aquí</h1>
    <a href="{{route('certificado')}}" target="_blank" class="btn btn-primary btn-pulse"><i class="fas fa-certificate"></i> CERTIFICADOS</a>
</div>
{{-- <div class="certificates-here-movil">
    <h1 class="text-white">Revisa tus certificados aquí</h1>
    <a href="{{route('certificate.view')}}" target="_blank" class="btn btn-primary"><i class="fas fa-certificate"></i> CERTIFICADOS</a>
</div> --}}
