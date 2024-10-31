
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Asignado</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 700px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #b7b7b7b9;
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            padding: 20px;
            text-align: justify;
        }
        .content h1 {
            color: #0058a3;
            font-size: 24px;
            text-align: center;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
            color: #666666;
        }

        .evidencia {
            padding: 20px;
            text-align: center;
        }

        .evidencia img {
            max-width: 150px;
            height: 100px;
            border-radius: 3%;
        }

        .footer {
            background-color: #e0e0e0;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #999999;
        }
        /* Boton */
        .centered {
            text-align: center;
            display: flex; /* Enables CSS flexbox */
            justify-content: center; /* horizontal */
            align-items: center; /*  vertical */
            height: 100%; /* Full height */
        }

        button {
            border: 1px solid #24b4fb;
            background-color: #0058a3;
            border-radius: 0.7em;
            cursor: pointer;
            padding: 0.5em 1em 0.6em 0.8em;
            font-size: 10px;
        }

        button span {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-weight: 500;
        }




    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://bibliotecadigital.telmex.com/bibliotecaDigital/resources/img/LOGO_BDT_Flag.png" alt="Telmex">
        </div>
        <div class="content">
            <h1>Informe de Correccion de Ticket <br>
                {{ $data['folio'] }} <br>
                {{ $data['casa'] }} -  {{ $data['area'] }}
            </h1>

            <p>
                A continuación, se detalla las observaciones a considerar para su validación.
            </p>
            <p>
                {{ $data['mensaje'] }}
            </p>
            <div class="centered">
                <a href="{{ route('crear.tickets') }}">
                    <button>
                        <span>
                            Corregir
                        </span>
                    </button>
                </a>
            </div>




            <p>
                Si tiene alguna pregunta o necesita más detalles sobre estos cambios, no dude en ponerse en contacto con nosotros.
                Agradecemos su colaboración continua para mejorar las condiciones de la casa.
            </p>
            <p>
                <h2 style="margin: 0;">Biblioteca Digital Telmex.</h2>
			</p>
        </div>
        <div class="footer">
            &copy; 2024 Telmex. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
