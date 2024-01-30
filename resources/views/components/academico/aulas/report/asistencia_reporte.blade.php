<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap'); */
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500&display=swap');
    @font-face {
        font-family: 'Open-Sans Regular';
        src: url('URL::asset("template/iconfonts/open-sans/OpenSans-Regular.ttf")');

    }
    @font-face {
        font-family: 'Open-Sans Bolt';
        src: local('Open-Sans Bold'), local('Open-Sans-Bold'), url('URL::asset("template/iconfonts/open-sans/OpenSans-Bold.ttf")') format("truetype");
    }
    @font-face {
        font-family: 'Open-Sans Medium';
        src: url('URL::asset("template/iconfonts/open-sans/OpenSans-Medium.ttf")');
    }
    @font-face {
        font-family: 'Open-Sans ExtraBold';
        src: url('URL::asset("template/iconfonts/open-sans/OpenSans-ExtraBold.ttf")');
    }

    body{
    }
    .table-bordered, .text-wrap table, .table-bordered th, .text-wrap table th, .table-bordered td, .text-wrap table td{
        /* border: 0.5px solid black; */
        border-left: 0.5px solid black;
        border-right: 0.5px solid black;
        border-top: 0.5px solid black;
        border-collapse: collapse;
        /* width: 100% */
    }
    .font-thead{
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 60%;
        /* width: 100% */
        background-color: #b4c6e7;
    }
    .pt-10{
        padding-top: 10px
    }

    .pb-10{
        padding-bottom: 10px
    }
    .pe-5{
        padding-right: 5px
    }
    .pe-10{
        padding-right: 10px
    }
    .pe-20{
        padding-right: 20px
    }
    .ps-5{
        padding-left: 5px
    }
    .ps-20{
        padding-left: 20px
    }
    .p-10{
        padding: 10px;
    }
    .p-5{
        padding: 5px;
    }
    .p-3{
        padding: 3px;
    }
    .text-center{
        text-align: center !important;
    }

    .font-alumnos{
        font-family: 'Open Sans', sans-serif;
        font-weight: 400;
        font-size: 50%;

        /* width: 100% */
    }
    .font-cabecera{
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 50%;


    }
    .bg-cabecera{
        background-color: #c6d9f1;
    }
    .text-start{
        text-align: left !important;
    }

    .table-bordered-logo
    /* , .text-wrap table
    , .table-bordered th
    , .text-wrap table th
    , .table-bordered td
    , .text-wrap table td */
    {
        border: 0.5px solid black;
        border-collapse: collapse;
        /* width: 100% */
    }
    .bordes{
        border: 0.5px solid black;
        border-collapse: collapse;
    }
    .mb-20{
        margin-bottom: 20px;
    }

    .table-bordered-asistencia, .text-wrap table, .table-bordered-asistencia th, .text-wrap table th, .table-bordered-asistencia td, .text-wrap table td{
        /* border: 0.5px solid black; */
        border-left: 0.5px solid black;
        border-right: 0.5px solid black;
        border-top: 0.5px solid black;
        border-bottom: 0.5px solid black;
        border-collapse: collapse;
        /* width: 100% */
    }

    @page { margin: 180px 50px; }
    #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 150px; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; }
    /* #footer .page:after { content: counter(page, upper-roman); } */
</style>
<body>
    @php
        $lista_alumnos = json_decode($alumnos);
        $cabecera_th = json_decode($cabecera);
    @endphp
    <div id="header">
        <table class="table-bordered-logo " width="100%">
            <thead>
                <tr>
                    <th class="font-cabecera text-center" width="12%">
                        <img src="{{public_path().'/'.$cabecera_th->logo}}" alt=""  width="50">

                    </th>
                    <th class="font-cabecera text-center " width="23%">
                        <h2>HB GROUP PERU</h2>
                        <h6>
                            REGISTRO DE ORGANIZACIÓN DE CAPACITACIÓN <br>
                            PORTUARIA <br>
                            N° 003-2019-APN/OCP/PS
                        </h6>
                    </th>
                    <th class="text-center font-cabecera bordes">
                        <h2>
                            REGISTRO DE ASISTENCIA <br> CURSOS
                        </h2>
                    </th>
                    <th class="text-center font-cabecera" width="12%">
                        <h6>F-004 Rv 03</h6>
                    </th>
                </tr>
            </thead>
        </table>
    </div>

    <div id="content">
        <table class="table-bordered-asistencia" width="100%">
            <thead>
                <tr>
                    <th class="text-start font-cabecera bg-cabecera p-5" width="17.8%" colspan="2" >ORGANIZACIÓN</th>
                    <th class="text-start font-cabecera " width="28.7%">&nbsp; {{$cabecera_th->organisacion}} </th>
                    <th class="text-start font-cabecera bg-cabecera p-5" width="28.7%">ID SISTEMA APN</th>
                    <th class="text-center font-cabecera" width="" colspan="4"> {{$cabecera_th->id_sistema_apn}} </th>
                </tr>
                <tr>
                    <th class="text-start font-cabecera bg-cabecera p-5" colspan="2">CURSO</th>
                    <th class="text-start font-cabecera" >&nbsp; {{$cabecera_th->curso}} </th>
                    <th class="text-start font-cabecera bg-cabecera p-5">MODALIDAD</th>
                    <th class="text-center font-cabecera" colspan="4"> {{$cabecera_th->modalidad}} </th>
                </tr>
                <tr>
                    <th class="text-start font-cabecera bg-cabecera p-5" colspan="2">FECHA</th>
                    <th class="text-start font-cabecera" >&nbsp; {{$cabecera_th->fecha}} </th>
                    <th class="text-start font-cabecera bg-cabecera p-5">HORARIO</th>
                    <th class="text-center font-cabecera" colspan="4"> {{$cabecera_th->horario}} </th>
                </tr>
                <tr>
                    <th class="text-start font-cabecera bg-cabecera p-5" colspan="2">INSTRUCTOR</th>
                    <th class="text-start font-cabecera" >&nbsp; {{$cabecera_th->instructor}} </th>
                    <th class="text-start font-cabecera bg-cabecera p-5">REGISTRO INSTRUCTOR</th>
                    <th class="text-center font-cabecera" colspan="4"> {{$cabecera_th->registro_instructor}} </th>
                </tr>
                <tr>
                    <th class="text-start font-cabecera bg-cabecera p-5" colspan="2">LUGAR DE DICTADO</th>
                    <th class="text-start font-cabecera" >&nbsp; {{$cabecera_th->lugar_dictado}} </th>
                    <th class="text-start font-cabecera bg-cabecera p-5">FIRMA DEL INSTRUCTOR</th>
                    <th class="text-center font-cabecera" colspan="4"> {{$cabecera_th->firma_instructor}} </th>
                </tr>


                <tr>
                    <th class="text-center font-thead pt-10 pb-10 pe-5 ps-5"rowspan="2" >N°</th>
                    <th class="text-center font-thead p-10 " rowspan="2">DOCUMENTO DE<br>IDENTIDAD NRO</th>
                    <th class="text-center font-thead p-10 " rowspan="2">NOMBRES</th>
                    <th class="text-center font-thead p-10 " rowspan="2">APELLIDOS PATERNO</th>
                    <th class="text-center font-thead p-10 " rowspan="2">APELLIDOS MATERNO</th>
                    <th class="text-center font-thead p-10 " colspan="2">CONTROL DE ASISTENCIA</th>
                    <th class="text-center font-thead p-10 " rowspan="2">COMENTARIOS</th>
                </tr>
                <tr>
                    <td  class="text-center font-thead" >PRESENTE</td>
                    <td  class="text-center font-thead" >AUSENTE</td>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0 ; $i<24 ; $i++)
                    {{-- @if ($i!=22) --}}
                        <tr>
                            <td  class="text-center font-alumnos p-5">{{ $i+1 }}</td>
                            <td  class="text-center font-alumnos p-5"></td>
                            <td  class="text-center font-alumnos p-5"></td>
                            <td  class="text-center font-alumnos p-5"></td>
                            <td  class="text-center font-alumnos p-5"></td>
                            <td  class="text-center font-alumnos p-5"></td>
                            <td  class="text-center font-alumnos p-5"></td>
                            <td  class="text-center font-alumnos p-5"></td>
                        </tr>
                    {{-- @endif --}}

                @endfor
                {{-- @foreach ($lista_alumnos as $key=>$value)
                <tr>
                    <td  class="text-center font-alumnos p-5">{{ $key+1 }}</td>
                    <td  class="text-center font-alumnos p-5">{{ $value->documento }}</td>
                    <td  class="text-center font-alumnos p-5">{{ $value->nombres }}</td>
                    <td  class="text-center font-alumnos p-5">{{ $value->apellido_paterno }}</td>
                    <td  class="text-center font-alumnos p-5">{{ $value->apellido_materno }}</td>
                    <td  class="text-center font-alumnos p-5">{{ ($value->asistencia==true?'X':'-') }}</td>
                    <td  class="text-center font-alumnos p-5">{{ ($value->asistencia==false?'X':'-') }}</td>
                    <td  class="text-center font-alumnos p-5">{{ $value->comentarios }}</td>
                </tr>
                @endforeach --}}

            </tbody>
        </table>

    </div>


    <div id="footer">
        <p class="page">pagina </p>
    </div>
</body>
</html>
