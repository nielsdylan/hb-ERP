@php
    $preguntas = $data->preguntas;
    $respuestas = $data->respuestas;
@endphp

<table class="table table-light">
    <tbody>
        <tr>
            <td>#</td>
            @foreach ( $preguntas as $key => $value )
                <td>{{ $value->pregunta }}</td>
            @endforeach
        </tr>
        @foreach ( $respuestas as $key => $value )
            <tr>
                <td>{{ $value->texto }}</td>
            </tr>
        @endforeach



    </tbody>
</table>
