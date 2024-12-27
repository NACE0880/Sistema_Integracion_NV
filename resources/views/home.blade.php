@extends('layouts.home')

@section('title')
    Panel
@endsection

@section('contenido')

    <div class="cards container mt-5">

        @if (in_array("1", $UsersServices->permisos()) ? true : false)
            <a href="{{ route('consultar.ticket') }}" class="card mantenimientos">
                <p class="tip">Mantenimientos</p>
                <p class="second-text"><i class="fa-solid fa-screwdriver-wrench"></i></p>
            </a>
        @endif

        @if (in_array("2", $UsersServices->permisos()) ? true : false)
            <a href="{{ route('consultar.tutoria') }}" class="card tutorias">
                <p class="tip">Tutorias</p>
                <p class="second-text"><i class="fa-solid fa-user-pen"></i></i></p>
            </a>
        @endif

        @if (in_array("3", $UsersServices->permisos()) ? true : false)
            <a href="{{ route('consultar.tutoria') }}" class="card mobiliario">
                <p class="tip">Mobiliario</p>
                <p class="second-text"><i class="fa-solid fa-truck-moving"></i></p>
            </a>
        @endif

    </div>


@endsection
