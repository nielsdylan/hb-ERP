
{{-- <body> --}}
@extends('web.layouts.app')
@section('title','Cuestionario')
@section('active_menu','active')
@section('content')
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="card">
                <form action="">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="card-body">
                        <h5 class="card-title">{{$cuestionario->nombre}}</h5>
                        <p class="card-text">Content</p>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
