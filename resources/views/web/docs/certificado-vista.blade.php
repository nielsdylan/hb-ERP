<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
{{-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Syne&display=swap" rel="stylesheet"> --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    body{
        font-family: 'Syne', sans-serif;
    }
    @font-face {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/roboto/v30/KFOmCnqEu92Fr1Mu72xKOzY.woff2) format('woff2');
        unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
    }
    @font-face {
        font-family: 'Calibre-Regular';
        src: url('{{public_path()."/web/assets/img/liston-sf-hb.png"}}' );
    }
    /* @font-face {
    font-family: 'Roboto';
        src: url('../fonts/Roboto/Roboto-Regular.ttf');
    } */
    .container{
        /* width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto; */
    }
    .text-center{
        text-align: center;
    }
    .text-right{
        text-align: right;
    }
    .text-white{
        color: white;
    }
    .text-blue{
        color: #002060
    }
    .margin-right-5{
        margin-right: 5px;
    }
    .margin-right-10{
        margin-right: 10px;
    }
    .margin-right-20{
        margin-right: 20px;
    }
    .margin-top-0{
        margin-top: 0px
    }
    .margin-bottom-0{
        margin-bottom: 0px
    }
    .margin-bottom-5{
        margin-bottom: 5px
    }
    .margin-bottom-10{
        margin-bottom: 10px
    }
    .margin-bottom-15{
        margin-bottom: 15px
    }
    .margin-bottom-20{
        margin-bottom: 20px
    }
    .margin-bottom-25{
        margin-bottom: 25px
    }
    .margin-bottom-30{
        margin-bottom: 30px
    }
    .margin-top-0{
        margin-top: 0px;
    }
    .margin-top-5{
        margin-top: 5px;
    }
    .margin-top-10{
        margin-top: 10px;
    }
    .margin-top-20{
        margin-top: 20px;
    }
    .margin-0{
        margin: 0px;
    }
    .border-pdf{
        border-right: 2.5px solid;
        border-top: 18.5px solid;
        border-bottom: 2.5px solid;
        border-left: 2.5px solid;
        border-color: #8090b0;
        height: 1010px;
        /* position: relative; */
    }
    .border-footer{
        border-top: 18.5px solid;
        border-color: #8090b0;
    }
    .border-number{
        border-right: 1.5px solid;
        border-top: 1.5px solid;
        border-bottom: 1.5px solid;
        border-left: 1.5px solid;
        border-color: #909cb2;
        padding-right: 20px;
        padding-left: 20px;
        padding-bottom: 0px;
        /* padding: 10px */
    }
    .border-solid{
        border: 1px solid;
        margin-top: 0px;
    }
    .liston-hb{
        width: 55%;
        height: 60px;
    }
    .liston-backgroun{
        align-items: center;
        background-image:url('{{public_path()."/web/assets/img/liston-sf-hb.png"}}');
        background-repeat: no-repeat;
        height: 60px;
        width:601px;
        margin-left: 45px;
    }
    .padding-top-liston{
        padding-top: 7px;
    }
    .padding-top-firma{
        /* padding-top: 135px; */
    }
    .padding-bottom-firma{
        padding-bottom: 100px;
    }
    .firma{
        /* position: absolute;
        right: 250px;
        top: 630px; */
    }
    .sello{
        /* position: absolute;
        right: 140px;
        top: 607px; */
    }
    .float-text{
        /* position: absolute;
        right: 250px;
        top: 630px; */
    }
    .sello-white{
        /* position: absolute;
        top: 750px;
        left: 65px; */
        border-radius:70px;
        opacity: 0.8;
    }
    #img-pdf{
        align-items: center;
        background-image:url('{{public_path()."/web/assets/img/fondo-hb.png"}}');
        background-size: cover;
        /* background-repeat: no-repeat; */
    }
    .font-size-12{
        font-size: 12px !important,
    }
    .padding-white{
        padding-bottom: 55px;
    }
    .td-img-sello-whited{
        padding-right: 110px;
        padding-top: 90px;
    }
    .position-footer{
        /* position: absolute; */
        /* top: 360px; */
    }
    .bloque {
        height: 200px;
        width: 200px;
        display: inline-table;
    }
    .tex {
        display: table-cell;
        vertical-align: middle;
    }

</style>
<body>
    <div class="container">
        <div id="img-pdf" class="border-pdf">
            <div class="text-right margin-top-10"><span class="border-number margin-right-20" style="font-size: 12px; color: #00000059 !import;font-family: 'Roboto', normal;">N&deg;: {{$json['number']}}</span></div>

            <div class="text-center"><img src="{{public_path().'/web/assets/img/logo_snc.png'}}" width="150"></div>
            <div class="text-center"><h3 class="margin-0">HB GROUP PERU</h3></div>
            <div class="liston-backgroun margin-bottom-30">
                <h1 class="text-white text-center padding-top-liston margin-bottom-0">CERTIFICADO</h1>
            </div>
            <div class="text-center"><h3 class="margin-top-0">OTORGADO A:</h3></div>
            <div class="text-center margin-bottom-15"><h1 class="margin-0 text-blue">{{$json['last_name'].' '.$json['name']}}</h1></div>
            <div class="text-center"><h2 class="margin-0 text-blue">Identificado con DNI N&deg; {{$json['document']}}</h2></div>
            <div class="text-center"><h2 class="margin-0 text-blue"> {{($json['business_curso']?'de la empresa '.$json['business_curso']:'')}} </h2></div>
            <div class="text-center margin-bottom-20 margin-top-20">Por haber aprobado satisfactoriamente el curso de:</div>

            <div class="text-center margin-bottom-30"><h2 class="margin-top-0 text-blue"> “{{$json['description']}}”</h2></div>


            <div class="text-center" style="font-family: 'Roboto', normal;">{{$json['date_1']}}</div>
            <div class="text-center" style="font-family: 'Roboto', normal;">{{$json['date_2']}}</div>
            <div class="text-center" style="font-family: 'Roboto', normal;">{{($json['fecha_vencimiento']?'Valido hasta '.$json['fecha_vencimiento']:'')}} </div>
            <div class="text-center" style="font-family: 'Roboto', normal;">{{($json['comentario']?$json['comentario']:'')}}</div>
            <div></div>
            <div class="text-center" style="position: absolute;top: 823px;left: 280px;"><img src="{{public_path().'/web/assets/img/user/'.$json['img_firm']}}" width="150"></div>
            <div class="text-center" style="position: absolute;top: 875px;left: 255px;"><hr size="1" width="150" class="border-solid"></div>
            <div class="text-center" style="position: absolute;top: 885px;left: 275px;font-weight: 700;"> {{ $json['name_firm'] }} </div>
            <div class="text-center" style="position: absolute;top: 905px;left: 305px;font-weight: 700;"> {{ $json['cargo_firm'] }} </div>
            <div class="text-center" style="position: absolute;top: 925px;left: 275px;font-weight: 700;"> {{ $json['business_firm'] }} </div>
            <img src="{{public_path().'/web/assets/img/sello-fondo-hb.png'}}" width="150" class="sello-white" style="position: absolute;top: 825px;">
            <img src="{{public_path().'/web/assets/img/sello-hb.png'}}" width="150" class="sello" style="position: absolute;top: 773px; left:430px">

            <div style="font-size: 14px;font-family: 'Roboto' !important;">
                <hr style="position: absolute;top: 975px;width: 100%;height: 20.5px;background-color: #8090b0;border: transparent;left: 0px;">
                <div style="position: absolute;top: 1005px;margin-left: 28px;">
                    <span>{{$json['name_business']}}</span> |
                    <img src="{{public_path().'/web/assets/img/telephone-cetificado.png'}}" width="15" class="firma"><span> {{$json['telephone']}}</span> |
                    <span>{{$json['cell']}}</span> |
                    <img src="{{public_path().'/web/assets/img/message-certificado.png'}}" width="15" class="firma"> <span>{{$json['email']}}</span> |
                    <img src="{{public_path().'/web/assets/img/web-certificado.png'}}" width="15" class="firma"> <span>{{$json['web']}}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
