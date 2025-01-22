{{-- vista extendida del layout --}}
@extends('layouts.tutorias')

@section('title')
    Panel Llamada
@endsection

@section('css')
    <style>
        .container {
            max-width: 90%;
            /* margin: 50px auto; */
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

            text-align:center;
        }

    </style>

    {{-- Cards --}}
    <style>
        .cards a{
            text-decoration: none;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
            justify-content: center;
        }

        .cards .card {
            background-color: rgba(255, 255, 255, 0.1);

            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;

            flex: 0 0 1;

            height: 150px;
            width: 100%;

            border-radius: 10px;
            color: black;
            cursor: pointer;

            transition: 400ms transform, 400ms box-shadow, 400ms background-color;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .cards .card p.tip {
            font-size: 1em;
            font-weight: 700;
        }

        .cards .card p.second-text {
            font-size: 2em;
        }

        .cards .card:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
            background-color: rgba(255, 255, 255, 0.1);
            color: #333;
        }

        .cards:hover > .card:not(:hover) {
            filter: blur(10px);
            transform: scale(0.9);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        @media screen and (min-width: 768px) {
            .cards .card {
                width: calc(100% / 4);
            }
        }

        /*COLOR HOVER*/
        .cards .internet:hover {
            transform: scale(1.1);
            background-color: #007ced;
            color: white;
        }
        .cards .infraestructura:hover {
            transform: scale(1.1);
            background-color: #e28743;
            color: white;
        }
        .cards .usobdt:hover {
            transform: scale(1.1);
            background-color: #b81e3e;
            color: white;
        }
        .cards .equipamiento:hover {
            transform: scale(1.1);
            background-color: #44347c;
            color: white;
        }
        .cards .mobiliario:hover {
            transform: scale(1.1);
            background-color: #ecbb37;
            color: white;
        }
    </style>
@endsection


@section('contenido')
    <div class="container form-container mt-5">
            <div class="form-header">
                <h2>{{ $adt->NOMBRE }} - {{$adt->CLAVE}}</h2>
            </div>

            <div class="cards  mt-5">
                    <a href="{{ route('actualizar.internet.adt', $adt) }}" class="card internet">
                        <p class="tip">Internet</p>
                        <p class="second-text"><i class="fa-solid fa-globe beat"></i></p>
                    </a>

                    <a href="{{ route('actualizar.infraestructura.adt', $adt) }}" class="card infraestructura">
                        <p class="tip">Infraestructura y Señalética</p>
                        <p class="second-text"><i class="fa-solid fa-road-bridge beat"></i></p>
                    </a>

                    <a href="{{ route('actualizar.uso.adt', $adt) }}" class="card usobdt">
                        <p class="tip">Uso BDT</p>
                        <p class="second-text"><i class="fa-solid fa-people-roof beat"></i></p>
                    </a>

                    <a href="{{ route('actualizar.equipamiento.adt', $adt) }}" class="card equipamiento">
                        <p class="tip">Equipamiento</p>
                        <p class="second-text"><i class="fa-solid fa-computer beat"></i></p>
                    </a>

                    <a href="{{ route('actualizar.mobiliario.adt', $adt) }}" class="card mobiliario">
                        <p class="tip">Mobiliario</p>
                        <p class="second-text"><i class="fa-solid fa-truck-moving beat"></i></p>
                    </a>
            </div>


            <form action="{{ route('panel.call.adt', $adt)}}" method="POST" enctype="multipart/form-data" onsubmit="showLoading()" class="row g-3 mt-5">
                {{-- Redireccionar a rutas de actualizacion  --}}
                @csrf
                @if(in_array("12", $UsersServices->permisos()) ? true : false)
                    {{-- Cambio de Estatus --}}
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-6">
                            <label for="estatus_adt" class="form-label">Estatus ADT Actual: {{ $adt->ESTATUS_ACTUAL }}</label>
                            <select id="estatus_adt" name="estatus_adt" class="form-select" disabled required>
                                <option value="">Seleccionar...</option>
                                <option value="ABIERTA">ABIERTA</option>
                                <option value="CERRADA">CERRADA</option>
                            </select>
                        </div>

                        <div class="form-check form-switch col-2 mt-auto">
                            <label class="form-check-label" for="editcheck_estatus_adt">Actualizar</label>
                            <input class="form-check-input" type="checkbox" id="editcheck_estatus_adt" data-select="select#estatus_adt" onclick="revisarCheck(this)">
                        </div>
                    </div>
                @endif
                
                {{-- Observaciones Finales--}}
                <div class="row g-3">
                    <div class="row g-1">
                        <div class="col-4">
                            <label for="videollamada">Video Llamada</label>

                            <input id="videollamada" name="videollamada" type="file" style="display: none" onchange="cambiarContenidoVideo(this)" accept=".mp4, .mov, .avi"   required /> <br>
                            <label id="lbl_videollamada" for="videollamada" class="btn btn-info" onmouseover="asignarNombre(this)">Adjuntar Video Llamada</label>

                            <br>
                            <label for="videollamada" class="file-note">Archivos mp4, mov, avi  </label>
                        </div>



                        <div class="col-4">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" maxlength="200" placeholder="Max 200 caracteres" required></textarea>
                        </div>

                        <div class="col-4">
                            <label for="expediente">Expediente</label>

                            <input id="expediente" name="expediente" type="file" style="display: none" onchange="cambiarContenidoExpediente(this)" accept=".pdf, .docx, .xlsx, .xls"   required /> <br>
                            <label id="lbl_expediente" for="expediente" class="btn btn-info" onmouseover="asignarNombre(this)">Adjuntar Expediente</label>

                            <br>
                            <label for="expediente" class="file-note">Archivos pdf, docx, xlsx, xls </label>
                        </div>
                    </div>

                </div>




                <div class="row g-3">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-custom"  onclick="cambiarBG();">Finalizar</button>
                    </div>
                    <div class="col-6">
                        <a  class="btn btn-danger btn-custom" href="{{ route('consultar.tutoria') }}">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
@endsection


@section('js')

    <script>
        $(".beat").hover(function () {
            $(this).toggleClass("fa-beat-fade");
        });
    </script>

    <script>
        //Habilitar Edición
        function revisarCheck(checkBox){
            var select = checkBox.getAttribute('data-select');
            $(select).attr("disabled", !checkBox.checked);
        }
    </script>

    <script>
        // MODIFICACION DE ELEMENTOS INPUT FILE
        let labelArchivo = '';

        function asignarNombre(lbl) {
            labelArchivo = lbl;
        }


        function cambiarContenidoVideo(inputArchivo) {
            // Tamaño maximo del archivo
            let maxSize = 5000000; //5mb -> 5,000,000

            // Validamos el primer archivo únicamente
            let archivo = inputArchivo.files[0];
            let nombreArchivo = inputArchivo.value;
            let idExtencion = nombreArchivo.lastIndexOf(".") + 1;
            let extArchivo = nombreArchivo.substr(idExtencion, nombreArchivo.length).toLowerCase();

            if (extArchivo=="mp4" && archivo.size <= maxSize|| extArchivo=="mov" && archivo.size <= maxSize|| extArchivo=="avi" && archivo.size <= maxSize){

                let nombreArchivo = inputArchivo.files[0].name;
                if (inputArchivo.value != "") {
                    labelArchivo.innerHTML = nombreArchivo;
                    labelArchivo.className = 'btn btn-success'

                }

            }else{
                inputArchivo.value = "";
                labelArchivo.className = 'btn btn-outline-danger'
                labelArchivo.innerHTML = "Adjuntar mp4,mov,avi - 5Mb máximo";

            }
        }

        function cambiarContenidoExpediente(inputArchivo) {
            // Tamaño maximo del archivo
            let maxSize = 5000000; //5mb -> 5,000,000

            // Validamos el primer archivo únicamente
            let archivo = inputArchivo.files[0];
            let nombreArchivo = inputArchivo.value;
            let idExtencion = nombreArchivo.lastIndexOf(".") + 1;
            let extArchivo = nombreArchivo.substr(idExtencion, nombreArchivo.length).toLowerCase();

            if (extArchivo=="pdf" && archivo.size <= maxSize|| extArchivo=="docx" && archivo.size <= maxSize|| extArchivo=="xlsx" && archivo.size <= maxSize|| extArchivo=="xls" && archivo.size <= maxSize){

                let nombreArchivo = inputArchivo.files[0].name;
                if (inputArchivo.value != "") {
                    labelArchivo.innerHTML = nombreArchivo;
                    labelArchivo.className = 'btn btn-success'

                }

            }else{
                inputArchivo.value = "";
                labelArchivo.className = 'btn btn-outline-danger'
                labelArchivo.innerHTML = "Adjuntar pdf, docx, xlsx, xls - 5Mb máximo";

            }
        }

        function cambiarBG(){
            let fileInputVideo = document.getElementById('videollamada');
            let lblfileInputVideo = document.getElementById('lbl_videollamada');

            let fileInputExpediente = document.getElementById('expediente');
            let lblfileInputExpediente = document.getElementById('lbl_expediente');


            if (fileInputVideo.value == ""){
                lblfileInputVideo.className = 'btn btn-warning';
            }

            if (fileInputExpediente.value == ""){
                lblfileInputExpediente.className = 'btn btn-warning';
            }
        }
    </script>

@endsection
