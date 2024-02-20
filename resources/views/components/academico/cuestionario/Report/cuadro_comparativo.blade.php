@php
    $preguntas = $data->preguntas;
    $respuestas = $data->respuestas;
@endphp

<table class="table table-light" style="text-align: center;">
    <tbody>
        <tr>
            <td  style="border: 0.5px solid black;">#</td>
            @foreach ( $preguntas as $key => $value )
                <td  style="border: 0.5px solid black;">{{ $value->pregunta }}</td>
            @endforeach
        </tr>
        @foreach ( $respuestas as $key => $value )
            <tr>
                <td  style="border: 0.5px solid black;">{{ $value->text }}</td>
                @foreach ( $preguntas as $key_pregunta => $value_pregunta )
                    <td  style="border: 0.5px solid black;border: 0.5px solid black; text-align: center;">{{ ($value_pregunta->id == $value->pregunta_id ? $value->cantidad : 0)  }}</td>
                @endforeach
            </tr>
        @endforeach



    </tbody>
</table>
