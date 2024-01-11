<!DOCTYPE html>
<html lang="en">
<head>
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
        border: 1px solid black;
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
</style>
<body>
    @php
        $lista_alumnos = json_decode($alumnos);
        $cabecera_th = json_decode($cabecera);
    @endphp
    <table class="table-bordered" width="100%">
        <thead>
            <tr>
                <th class="text-start font-cabecera bg-cabecera p-5"width="17.8%" >ORGANIZACIÓN</th>
                <th class="text-start font-cabecera bg-cabecera p-5" width="28.7%">ID SISTEMA APN</th>
                <th class="text-start font-cabecera bg-cabecera p-5" width="28.7%">ID SISTEMA APN</th>
            </tr>
        </thead>
    </table>

    <table class="table-bordered" width="100%">
        <thead>
            <tr>
                <th class="text-start font-cabecera bg-cabecera p-5"width="17.8%" >ORGANIZACIÓN</th>
                <th class="text-start font-cabecera " width="28.7%"> {{$cabecera_th->organisacion}} </th>
                <th class="text-start font-cabecera bg-cabecera p-5" width="28.7%">ID SISTEMA APN</th>
                <th class="text-center font-cabecera" width=""> {{$cabecera_th->id_sistema_apn}} </th>
            </tr>
            <tr>
                <th class="text-start font-cabecera bg-cabecera p-5">CURSO</th>
                <th class="text-start font-cabecera" > {{$cabecera_th->curso}} </th>
                <th class="text-start font-cabecera bg-cabecera p-5">MODALIDAD</th>
                <th class="text-center font-cabecera" > {{$cabecera_th->modalidad}} </th>
            </tr>
            <tr>
                <th class="text-start font-cabecera bg-cabecera p-5" >FECHA</th>
                <th class="text-start font-cabecera" > {{$cabecera_th->fecha}} </th>
                <th class="text-start font-cabecera bg-cabecera p-5">HORARIO</th>
                <th class="text-center font-cabecera" > {{$cabecera_th->horario}} </th>
            </tr>
            <tr>
                <th class="text-start font-cabecera bg-cabecera p-5" >INSTRUCTOR</th>
                <th class="text-start font-cabecera" > {{$cabecera_th->instructor}} </th>
                <th class="text-start font-cabecera bg-cabecera p-5">REGISTRO INSTRUCTOR</th>
                <th class="text-center font-cabecera" > {{$cabecera_th->registro_instructor}} </th>
            </tr>
            <tr>
                <th class="text-start font-cabecera bg-cabecera p-5" >LUGAR DE DICTADO</th>
                <th class="text-start font-cabecera" > {{$cabecera_th->lugar_dictado}} </th>
                <th class="text-start font-cabecera bg-cabecera p-5">FIRMA DEL INSTRUCTOR</th>
                <th class="text-center font-cabecera" > {{$cabecera_th->firma_instructor}} </th>
            </tr>
        </thead>
    </table>
    <table class="table-bordered" width="100%">
        <thead>


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
            @foreach ($lista_alumnos as $key=>$value)
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
            @endforeach

        </tbody>
    </table>


</body>
</html>
