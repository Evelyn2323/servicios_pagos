<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Servicios Pagos</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Estilos personalizados -->
        <style>
            body {
                background-image: url('{{ asset('images/Servicios.jpg') }}');
                background-size: cover;
                background-position: center;
                font-family: 'Figtree', sans-serif;
                color: white;
            }

            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }

            .content {
                text-align: center;
                background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro para el texto */
                padding: 20px;
                border-radius: 8px;
                max-width: 400px;
                width: 100%;
            }

            .content h1 {
                font-size: 3rem;
                margin-bottom: 20px;
            }

            .content button {
                background-color: #824c13aa; /* Azul */
                color: white;
                padding: 10px 20px;
                border-width: 1px;
                border-color: #ffffffab;
                border-radius: 5px;
                font-size: 1.2rem;
                width: 100%;
                margin-bottom: 10px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .content button:hover {
                background-color: #2563EB; /* Azul más oscuro al pasar el mouse */
            }
        </style>
    </head>
    <body>

        <div class="container">
            <div class="content">
                <h1>Bienvenido a Servicios Pagos</h1>
                <a href="{{ route('login') }}">
                    <button>Iniciar Sesión</button>
                </a>
                <a href="{{ route('register') }}">
                    <button>Registrarse</button>
                </a>
            </div>
        </div>

    </body>
</html>
