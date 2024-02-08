
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
            <tr>
                <th width="40px"></th>
                <th class="" >&nbsp;&nbsp;&nbsp;
                    <div ><img src="{{public_path().'/'.$cabecera_th->logo}}" alt=""  width="50"></div>

                </th>
                <th class=" "width="150px">
                    HB GROUP PERÚ

                </th>
                <th class=" bordes">
                    <h2>
                        REGISTRO DE ASISTENCIA <br> CURSOS
                    </h2>
                </th>
                <th class="">
                    <h6>F-004 Rv 03</h6>
                </th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th  width="150px">

                    REGISTRO DE ORGANIZACIÓN DE CAPACITACIÓN <br>
                    PORTUARIA <br>
                    N° 003-2019-APN/OCP/PS
                </th>
            </tr>


             <tr>
                <th class=" "  colspan="2" >ORGANIZACIÓN</th>
                <th class=""  colspan="2" >&nbsp; {{$cabecera_th->organisacion}} </th>
                <th class=" " >ID SISTEMA APN</th>
                <th class="" width="" colspan="3"> {{$cabecera_th->id_sistema_apn}} </th>
            </tr>

            <tr>
                <th class="  " colspan="2">CURSO</th>
                <th class=""colspan="2" >&nbsp; {{$cabecera_th->curso}} </th>
                <th class="  ">MODALIDAD</th>
                <th class="" colspan="3"> {{$cabecera_th->modalidad}} </th>
            </tr>
            <tr>
                <th class="  " colspan="2">FECHA</th>
                <th class="" colspan="2">&nbsp; {{$cabecera_th->fecha}} </th>
                <th class="  ">HORARIO</th>
                <th class="" colspan="3"> {{$cabecera_th->horario}} </th>
            </tr>
            <tr>
                <th class="  " colspan="2">INSTRUCTOR</th>
                <th class="" colspan="2">&nbsp; {{$cabecera_th->instructor}} </th>
                <th class="  ">REGISTRO INSTRUCTOR</th>
                <th class="" colspan="3"> {{$cabecera_th->registro_instructor}} </th>
            </tr>
            <tr>
                <th class="  " colspan="2">LUGAR DE DICTADO</th>
                <th class="" colspan="2">&nbsp; {{$cabecera_th->lugar_dictado}} </th>
                <th class="  ">FIRMA DEL INSTRUCTOR</th>
                <th class="" colspan="3"> {{$cabecera_th->firma_instructor}} </th>
            </tr>{{-- --}}
            <tr>
                <th class=" "rowspan="2" width="25px">N°</th>
                <th class="   " rowspan="2" width="80px">DOCUMENTO DE<br>IDENTIDAD NRO</th>
                <th class="  " rowspan="2" width="80px">NOMBRES</th>
                <th class="  " rowspan="2" width="80px">APELLIDOS PATERNO</th>
                <th class="  " rowspan="2" width="80px">APELLIDOS MATERNO</th>
                <th class="  " colspan="2" width="80px">CONTROL DE ASISTENCIA</th>
                <th class="  " rowspan="2" width="80px">COMENTARIOS</th>
            </tr>
            <tr>
                <td  class=" " >PRESENTE</td>
                <td  class=" " >AUSENTE</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($lista_alumnos as $key=>$value)
            <tr>
                <td  class=" ">{{ $key+1 }}</td>
                <td  class=" ">{{ $value->documento }}</td>
                <td  class=" ">{{ $value->nombres }}</td>
                <td  class=" ">{{ $value->apellido_paterno }}</td>
                <td  class=" ">{{ $value->apellido_materno }}</td>
                <td  class=" ">{{ ($value->asistencia==true?'PRESENTE':'-') }}</td>
                <td  class=" ">{{ ($value->asistencia==false?'AUSENTE':'-') }}</td>
                <td  class=" ">{{ $value->comentarios }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div id="footer" > --}}
        {{-- <table class="" >
            <thead>
                <tr>
                    <th class="" >
                        <hr class="">
                        <div class="">FIRMA DIGITAL DEL INSTRUCTOR</div>
                        <div class="">{{$cabecera_th->instructor}}</div>
                        <div class="">DNI: {{$cabecera_th->numero_documento}}</div>
                    </th>
                    <th class="" width="" >
                        <hr class="">
                        <div class="">FIRMA DIGITAL DEL REPRESENTANTE OCP</div>
                        <div class="">ANNIE BEJARANO</div><br>
                    </th>
                </tr>
            </thead>
        </table> --}}
    {{-- </div> --}}
