
    @php
        $lista_alumnos = $data->alumnos;
        $cabecera_th = $data->cabecera;
    @endphp
    {{-- <div id="header"> --}}
        <table class=" ">
            <thead>
                {{-- <tr>
                    <th width="40px"rowspan="2"></th>
                    <th class="" width="40px" rowspan="2">&nbsp;&nbsp;&nbsp;
                        <div ><img src="{{public_path().'/'.$cabecera_th->logo}}" alt=""  width="50"></div>

                    </th>
                    <th class=" "width="150px">
                        HB GROUP PERÚ

                    </th>
                    <th class=" bordes"colspan="2"rowspan="2">
                        <h2>
                            REGISTRO DE ASISTENCIA <br> CURSOS
                        </h2>
                    </th>
                    <th class=""colspan="2"rowspan="2">
                        <h6>F-004 Rv 03</h6>
                    </th>
                </tr>
                <tr>
                    <th  width="150px">

                        REGISTRO DE ORGANIZACIÓN DE CAPACITACIÓN <br>
                        PORTUARIA <br>
                        N° 003-2019-APN/OCP/PS
                    </th>
                </tr> --}}
            </thead>
        </table>
    {{-- </div> --}}

    <table class="">
        <thead>
            <tr >
                <th width="40px" style="border-left: 0.5px solid black;border-top: 0.5px solid black;"></th>
                <th class="" style="border-top: 0.5px solid black;">&nbsp;&nbsp;&nbsp;
                    <div ><img src="{{public_path().'/'.$cabecera_th->logo}}" alt=""  width="50"></div>

                </th>
                <th class=" " style="border: 0.5px solid black;">
                    <br>
                    HB GROUP PERÚ
                    <br>
                    REGISTRO DE ORGANIZACIÓN DE CAPACITACIÓN <br>
                    PORTUARIA <br>
                    N° 003-2019-APN/OCP/PS<br>
                </th>
                <th style="border: 0.5px solid black;"></th>
                <th class=" bordes" style="border: 0.5px solid black;">
                    <h2>
                        REGISTRO DE ASISTENCIA <br> CURSOS
                    </h2>
                </th>
                <th style="border: 0.5px solid black;"></th>

                <th class="" style="border: 0.5px solid black;">
                    <h6>F-004 Rv 03</h6>
                </th>
                <th style="border: 0.5px solid black;"></th>
            </tr>
            <tr>
                <th style="border-left: 0.5px solid black;border-bottom: 0.5px solid black;"></th>
                <th style="border-bottom: 0.5px solid black;"></th>
                <th style="border: 0.5px solid black;" ></th>
                <th style="border: 0.5px solid black;" ></th>
                <th style="border: 0.5px solid black;" ></th>
                <th style="border: 0.5px solid black;" ></th>
                <th style="border: 0.5px solid black;" ></th>
                <th style="border: 0.5px solid black;" ></th>
            </tr>
            <tr></tr>


             <tr>
                <th class=" "  colspan="2" style="border: 0.5px solid black;background-color: #c6d9f1;">ORGANIZACIÓN</th>
                <th class=""  colspan="2" style="border: 0.5px solid black;">&nbsp; {{$cabecera_th->organisacion}} </th>
                <th class=" " style="border: 0.5px solid black;background-color: #c6d9f1;">ID SISTEMA APN</th>
                <th class="" width="" colspan="3"style="border: 0.5px solid black;"> {{$cabecera_th->id_sistema_apn}} </th>
            </tr>

            <tr>
                <th class="  " colspan="2"style="border: 0.5px solid black;background-color: #c6d9f1;">CURSO</th>
                <th class=""colspan="2" style="border: 0.5px solid black;">&nbsp; {{$cabecera_th->curso}} </th>
                <th class="  "style="border: 0.5px solid black;background-color: #c6d9f1;">MODALIDAD</th>
                <th class="" colspan="3"style="border: 0.5px solid black;"> {{$cabecera_th->modalidad}} </th>
            </tr>
            <tr>
                <th class="  " colspan="2"style="border: 0.5px solid black;background-color: #c6d9f1;">FECHA</th>
                <th class="" colspan="2"style="border: 0.5px solid black;">&nbsp; {{$cabecera_th->fecha}} </th>
                <th class="  "style="border: 0.5px solid black;background-color: #c6d9f1;">HORARIO</th>
                <th class="" colspan="3"style="border: 0.5px solid black;"> {{$cabecera_th->horario}} </th>
            </tr>
            <tr>
                <th class="  " colspan="2"style="border: 0.5px solid black;background-color: #c6d9f1;">INSTRUCTOR</th>
                <th class="" colspan="2"style="border: 0.5px solid black;">&nbsp; {{$cabecera_th->instructor}} </th>
                <th class="  "style="border: 0.5px solid black;background-color: #c6d9f1;">REGISTRO INSTRUCTOR</th>
                <th class="" colspan="3"style="border: 0.5px solid black;"> {{$cabecera_th->registro_instructor}} </th>
            </tr>
            <tr>
                <th class="  " colspan="2"style="border: 0.5px solid black;background-color: #c6d9f1;">LUGAR DE DICTADO</th>
                <th class="" colspan="2"style="border: 0.5px solid black;">&nbsp; {{$cabecera_th->lugar_dictado}} </th>
                <th class="  "style="border: 0.5px solid black;background-color: #c6d9f1;">FIRMA DEL INSTRUCTOR</th>
                <th class="" colspan="3"style="border: 0.5px solid black;"> {{$cabecera_th->firma_instructor}} </th>
            </tr>{{-- --}}
            <tr>
                <th class=" "rowspan="2" width="25px"style="border: 0.5px solid black;background-color: #b4c6e7;">N°</th>
                <th class="   " rowspan="2" width="80px"style="border: 0.5px solid black;background-color: #b4c6e7;">DOCUMENTO DE<br>IDENTIDAD NRO</th>
                <th class="  " rowspan="2" width="40px"style="border: 0.5px solid black;background-color: #b4c6e7;">NOMBRES</th>
                <th class="  " rowspan="2" width="80px"style="border: 0.5px solid black;background-color: #b4c6e7;">APELLIDOS PATERNO</th>
                <th class="  " rowspan="2" width="80px"style="border: 0.5px solid black;background-color: #b4c6e7;">APELLIDOS MATERNO</th>
                <th class="  " colspan="2" width="80px"style="border: 0.5px solid black;background-color: #b4c6e7;">CONTROL DE ASISTENCIA</th>
                <th class="  " rowspan="2" width="80px"style="border: 0.5px solid black;background-color: #b4c6e7;">COMENTARIOS</th>
            </tr>
            <tr>
                <td  class=" " style="border: 0.5px solid black;background-color: #b4c6e7;" >PRESENTE</td>
                <td  class=" " style="border: 0.5px solid black;background-color: #b4c6e7;"  >AUSENTE</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($lista_alumnos as $key=>$value)
            <tr>
                <td  class=" "style="border: 0.5px solid black;">{{ $key+1 }}</td>
                <td  class=" "style="border: 0.5px solid black;">{{ $value->documento }}</td>
                <td  class=" "style="border: 0.5px solid black;" width="110px">{{ $value->nombres }}</td>
                <td  class=" "style="border: 0.5px solid black;">{{ $value->apellido_paterno }}</td>
                <td  class=" "style="border: 0.5px solid black;">{{ $value->apellido_materno }}</td>
                <td  class=" "style="border: 0.5px solid black;">{{ ($value->asistencia==true?'PRESENTE':'-') }}</td>
                <td  class=" "style="border: 0.5px solid black;">{{ ($value->asistencia==false?'AUSENTE':'-') }}</td>
                <td  class=" "style="border: 0.5px solid black;">{{ $value->comentarios }}</td>
            </tr>
            @endforeach

            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr>
                <td></td>
                <td class="" style="border-top: 0.5px solid black;">

                    <br>
                    FIRMA DIGITAL DEL INSTRUCTOR <br>
                    {{$cabecera_th->instructor}}<br>
                    DNI: {{$cabecera_th->numero_documento}}
                </td>
                <td style="border-top: 0.5px solid black;"></td>
                <td></td>
                <td class=""style="border-top: 0.5px solid black;">
                    <br>
                    FIRMA DIGITAL DEL REPRESENTANTE OCP<br>
                    ANNIE BEJARANO<br>
                </td>
                <td style="border-top: 0.5px solid black;"></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    {{-- <div id="footer" > --}}
        {{-- <table class="" >
            <thead>
                <tr>
                    <th class="" colspan="2">
                        <hr class="">
                        <div class="">FIRMA DIGITAL DEL INSTRUCTOR</div>
                        <div class="">{{$cabecera_th->instructor}}</div>
                        <div class="">DNI: {{$cabecera_th->numero_documento}}</div>
                    </th>
                    <th class="" width="" colspan="2">
                        <hr class="">
                        <div class="">FIRMA DIGITAL DEL REPRESENTANTE OCP</div>
                        <div class="">ANNIE BEJARANO</div><br>
                    </th>
                </tr>
            </thead>
        </table> --}}
    {{-- </div> --}}
