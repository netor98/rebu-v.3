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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white dark:bg-gray-900">
            <div class="md:flex md:justify-center md:items-center md:gap-4 w-full my-32">
                <!-- Verificar si la ruta actual es 'login' o 'register' -->
                @if (Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register')
                    <!-- Div para la imagen -->
                    <div class="md:w-6/12 p-5 hidden md:block">
                        @if (Route::currentRouteName() == 'login')
                            <img src="{{ asset('img/fondo-login.jpg')}}" alt="Imagen de fondo" class="max-w-full h-auto">
                        @elseif (Route::currentRouteName() == 'register')
                            <img src="{{ asset('img/fondo.jpg')}}" alt="Imagen de fondo" class="max-w-full h-auto">
                        @endif
                    </div>
                @endif
            
                <!-- Div para el contenido del formulario y el título -->
                <div class="md:w-4/12 bg-gray-200 p-5 shadow-xl rounded-lg">
                    <div>
                        @if (Route::currentRouteName() == 'login')
                            <h2 class="text-center font-black text-3xl ">Iniciar sesión</h2>
                        @elseif (Route::currentRouteName() == 'register')
                            <h2 class="text-center font-black text-3xl">Registrarse</h2>
                        @endif
                    </div>
            
                    <div>
                        {{ $slot }} <!-- Asumo que aquí irán los campos del formulario -->
                    </div>   
                </div>
            </div>
                        
            
            
        </div>
        
    </body>
</html>
