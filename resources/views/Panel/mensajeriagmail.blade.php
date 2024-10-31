{{-- vista extendida del layout --}}
@extends('layouts.base')

{{-- introducir solo titulo --}}
@section('title', 'INDEX')

@section('css')

@endsection


@section('contenido')

    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2 class="gmail">Mensajes</h2>
                <h5 >Envio de correos y Pruebas</h5>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <iframe src="{{url('planos/fintutoria.blade.php')}}"
                style="width: 100%; height: 400px;">
                    Your browser isn't compatible
                </iframe>
            </div>

            <div class="col-md-4 col-sm-12 col-xs-12">
                <iframe src="{{url('planos/reporteinternet.blade.php')}}"
                style="width: 100%; height: 400px;">
                    Your browser isn't compatible
                </iframe>
            </div>

            <div class="col-md-4 col-sm-12 col-xs-12">
                <iframe src="{{url('planos/reportesemanal.blade.php')}}"
                style="width: 100%; height: 400px;">
                    Your browser isn't compatible
                </iframe>
            </div>

            


        </div>


    </div>
    <!-- /. PAGE INNER  -->
@endsection

@section('js')

@endsection
