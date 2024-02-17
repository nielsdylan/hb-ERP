@php
    $preguntas = $data->preguntas;
    $respuestas = $data->respuestas;
@endphp

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            @foreach ( $respuestas as $key => $value )
                <th>{{$value}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ( $preguntas as $key => $value )
            <tr>
                <td>{{ $value->pregunta }}</td>
            </tr>
        @endforeach

    </tbody>
</table>
