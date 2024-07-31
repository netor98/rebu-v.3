<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="icon" type="image/x-icon" href="{{asset('img/logo.png    ')}}">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
         <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
         <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
         <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
         <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
     

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
        <style>
            .swiper-button-next, .swiper-button-prev {
            color: #B67352; /* Cambia el color de los botones de navegación */
            width: 30px; /* Cambia el ancho de los botones de navegación */
            height: 30px; /* Cambia la altura de los botones de navegación */
        }

        .swiper-button-next:after, .swiper-button-prev:after {
            font-size: 20px; /* Cambia el tamaño de la flecha en los botones de navegación */
        }

        .swiper-pagination-bullet {
            background: #B67352; /* Cambia el color de las balas de paginación */
        }
        .swiper-pagination {
            bottom: -2% !important;
        }

        .swiper-container {
            overflow: hidden; /* Asegura que no haya desplazamiento horizontal */
        }

        

            /* .swiper-slide {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .swiper-slide img {
                object-fit: cover;
            } */
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-white dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="">
                {{ $slot }}
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const alert = document.getElementById('alert-border-3');
                if (alert) {
                    setTimeout(() => {
                        alert.remove();
                    }, 2500);
                }
            });
        </script> 
    </body>
</html>
