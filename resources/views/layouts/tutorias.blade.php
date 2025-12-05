<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        .file-note{
            color: gray;
            font-style:italic;
            font-family: cursive;
            font-size: 14px;
        }

        .form-container {
            max-width: 900px;
            /* margin: 50px auto; */
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }
        .row label {
            font-weight: bold;
        }
        .form-group select,
        .form-group input,
        .form-group textarea {
            border-radius: 5px;
        }
        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-custom {
            width: 100%;
            padding: 10px;
            font-size: 15px;
        }

        .btn-custom-end-dataTable {
            margin-top: 20px;
            margin-right: 10px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0;
            margin-left: 2px;
            border-radius: 3px;
        }
        /* LOADER */
        .loading {
            z-index: 20;
            position: absolute;
            top: 0;
            /* left:-5px; */
            width: 100%;
            height: 130%;
            background-color: rgba(0, 0, 0, 0.168);
        }

        /*CIRCULO*/
        .loading-content {
            position: absolute;
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #0099ff; /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            top: 50%;
            left:50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* INPUTS file */


    </style>

    @yield('css')
</head>

<body>
    <section id="loading">
        <div id="loading-content"></div>
    </section>

    {{-- BARRA DE NAVEGACIÓN --}}
    @auth
        <ul class="nav nav-tabs justify-content-center">

            <li class="nav-item">
                <a class="nav-link {{ Route::is('consultar.tutoria') ? 'active' : '' }}" href="{{ route('consultar.tutoria') }}"> <i class="fa-solid fa-house"></i> Entidades </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::is('consultar.estatus.bdt.tutorias') ? 'active' : '' }}" href="{{ route('consultar.estatus.bdt.tutorias') }}">
                <i class="fa-solid fa-chart-simple">
                </i> 
                    Estado 
                </a>
            </li>

            {{-- USUARIO --}}
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->userable->NOMBRE }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                    <li>
                        <a class="dropdown-item" href="{{ route('home') }}">
                            Menu
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>

        </ul>
    @endauth


    @yield('contenido')



    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/sorting/natural.js"></script>

    <script>
        function showLoading() {
            document.querySelector('#loading').classList.add('loading');
            document.querySelector('#loading-content').classList.add('loading-content');
        }

        function hideLoading() {
            document.querySelector('#loading').classList.remove('loading');
            document.querySelector('#loading-content').classList.remove('loading-content');
        }

    </script>

    @yield('js')
</body>
</html>
