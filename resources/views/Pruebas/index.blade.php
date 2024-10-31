{{-- <div>PRUEBAS . INDEX</div> --}}
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<style>
    table{
        width: 100%;
        color:white;
        text-align: center;
    }

</style>
<body>
    <div class="table-responsive">
        {{-- table table-dark table-striped  table-hover --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="100%" >
                        <h1>HISTORICO DE PERSONAS INSCRITAS</h1>
                        {{-- <h2>{{ $chunksize }}</h2> --}}
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td colspan="40%" >
                        <h3>SEDENA</h3>
                        <h3>{{ $sedena['sedena'] }}</h3>
                    </td>

                    <td colspan="60%">
                            <h2>GUARDIA NACIONAL</h2>
                            <h3>{{ $gn['guardia nacional'] }}</h3>
                        </td>
                </tr>

                <tr>
                    <td colspan="20%">
                        <table class="table table-striped  table-hover">
                            <thead>
                                <tr>
                                    <th colspan="50%">
                                        Region
                                    </th>

                                    <th colspan="50%">
                                        Cantidad
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($regiones_sdn as $palabra => $rep)
                                    <tr>
                                        <td colspan="50%">
                                            {{ $palabra }}
                                        </td>

                                        <td colspan="50%">
                                            {{ $rep }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </td>

                    <td colspan="20%">
                        <table class="table table-striped  table-hover">
                            <thead>
                                <tr>
                                    <th colspan="50%">
                                        Zona
                                    </th>

                                    <th colspan="50%">
                                        Cantidad
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($zonas_sdn as $palabra => $rep)
                                    <tr>
                                        <td colspan="50%" style="text-align: justify">
                                            {{ $palabra }}
                                        </td>

                                        <td colspan="50%">
                                            {{ $rep }}
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </td>

                    <td colspan="20%">
                        <table class="table table-striped  table-hover">
                            <thead>
                                <tr>
                                    <th colspan="50%">
                                        Region
                                    </th>

                                    <th colspan="50%">
                                        Cantidad
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($regiones_gn as $palabra => $rep)
                                    <tr>
                                        <td colspan="50%">
                                            {{ $palabra }}
                                        </td>

                                        <td colspan="50%">
                                            {{ $rep }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </td>

                    <td colspan="20%">
                        <table class="table table-striped  table-hover">
                            <thead>
                                <tr>
                                    <th colspan="50%">
                                        Zona
                                    </th>

                                    <th colspan="50%">
                                        Cantidad
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($zonas_gn as $palabra => $rep)
                                    <tr>
                                        <td colspan="50%" style="text-align: justify">
                                            {{ $palabra }}
                                        </td>

                                        <td colspan="50%">
                                            {{ $rep }}
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </td>

                    <td colspan="20%">
                        <table class="table table-striped  table-hover">
                            <thead>
                                <tr>
                                    <th colspan="50%">
                                        Estados
                                    </th>

                                    <th colspan="50%">
                                        Cantidad
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estados_gn as $palabra => $rep)
                                    <tr>
                                        <td colspan="50%" style="text-align: justify">
                                            {{ $palabra }}
                                        </td>

                                        <td colspan="50%">
                                            {{ $rep }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </td>

                </tr>


            </tbody>
        </table>
    </div>


</body>
</html>
