
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @php
        $imagenes =  json_decode($data);
    @endphp
    
    @foreach ($imagenes as $value)
        @if ($value->path_dni)
        <p>{{ asset(''.$value->path_dni) }}</p>
            <div style="margin: 25px !important;"><img src="{{ asset('').$value->path_dni }}" width="100%" ></div>
        @endif
    @endforeach
</body>
</html>
