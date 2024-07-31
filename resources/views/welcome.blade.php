<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>REBU - @yield('titulo')</title>
        @vite('resources/css/app.css')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
            crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    </head>
    <body>
        <header class="bg-white border-b shadow-md fixed top-0 w-full z-50">
            <div class="container mx-auto flex justify-between items-center">
                <nav class=" w-full top-0 start-0 border-gray-200">
                    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

                        @auth
                            <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
                                <img src="{{ asset('img/logo.png') }}" class="h-9" alt="Flowbite Logo">
                                <span class="self-center text-3xl font-semibold whitespace-nowrap text-black">Rebu</span>
                            </a>

                            
                        @endauth

                        @guest
                            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                                <img src="{{ asset('img/logo.png') }}" class="h-9" alt="Flowbite Logo">
                                <span class="self-center text-3xl font-semibold whitespace-nowrap text-black">Rebu</span>
                            </a>
                        @endguest
                        
                        

                        <div class="flex sm:hidden md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-black rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-sticky" aria-expanded="false">
                                    <span class="sr-only">Abrir menú</span>
                                    
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                                    </svg>
                                </button>
                        </div>

                       

                        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-3" id="navbar-sticky">
                            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-3 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white items-center">
                                @auth
                                    <li>
                                        <a href="#" class="font-bold text-gray-500">Hola:
                                            <span class="font-normal">
                                                {{ auth()->user()->name }}</a>
                                            </span> 
                                    </li>
                                    @if(auth()->user()->id == 1)
                                        <li>
                                            <a href="{{ route('shop') }}" >
                                                <div class="text-black shadow rounded-full p-2 hover:bg-gray-200">
                                                    <svg class=""  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 6c0 1.657-3.134 3-7 3S5 7.657 5 6m14 0c0-1.657-3.134-3-7-3S5 4.343 5 6m14 0v6M5 6v6m0 0c0 1.657 3.134 3 7 3s7-1.343 7-3M5 12v6c0 1.657 3.134 3 7 3s7-1.343 7-3v-6"/>
                                                    </svg>
                                                </div>
                                            </a>
                                        </li>

                                        
                                    @endif
                                    <li class="relative">
                                        <a href="{{ route('details')}}" class="text-black block shadow rounded-full p-2 hover:bg-gray-200 cursor-pointer" id="shop-cart">
                                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                                            </svg>
                                        </a>

                                       

                                        <div class="absolute bg-red-600 text-white text-base -top-1 -right-1 rounded-full grid place-items-center w-[15px]"
                                            id="counter-products">
                                            {{count((array) session('cart'))}}
                                        </div>
                                          
                                    </li>
                                    
                                    <li>
                                        <a href="{{ route('logout') }}" class=" text-black hover:bg-gray-200 transition-all shadow-lg font-semibold border-black  rounded-xl text-base px-4 py-2 text-center">Cerrar sesión</a>
                                    </li>

                                @endauth
                               
                                @guest
                                    <li>
                                        <a href="/login" class="text-white bg-orange-500 hover:bg-orange-800 font-medium rounded-lg text-base px-4 py-2 text-center">Iniciar sesión</a>
                                    </li>

                                    <li>
                                        <a href="{{ route("register")}}" class="text-white bg-orange-500 hover:bg-orange-800 font-medium rounded-lg text-base px-4 py-2 text-center">Registrarse</a>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>


        <main class="">
            <img src="{{ asset('img/index-hero.png') }}" alt="Hero Image" class="bg-cover">
    
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white">
                    <h1 class="text-xl md:text-4xl font-bold mb-4">
                        Tu comida favorita,
                        a solo un toque de distancia.
                    </h1>
            
                    @auth
                        <a href="{{route('shop')}}" class="text-base md:text-lg text-white bg-green-700 hover:bg-green-800 font-bold py-2 px-4 mt-4 focus:ring-blue-300 rounded-lg  text-center inline-flex items-center me-2 ">
                            <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                                <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                            </svg>
                            ORDENA YA!
                        </a>
                    @endauth
    
                    @guest
                        <a href="{{ route('login') }}" class="text-base md:text-lg text-white bg-green-700 hover:bg-green-800 font-bold py-2 px-4 mt-4 focus:ring-blue-300 rounded-lg  text-center inline-flex items-center me-2 ">
                            <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                                <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                            </svg>
                            ORDENA YA!
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    
        <div class="mx-auto container mt-10">
            <h2 class="text-2xl font-bold mb-5">¿Dónde estamos?</h2>
         
            <div class="max-w-3xl mx-auto ">

                <div id="map" class="border shadow-xl h-96 my-5 mb-7 z-0"></div>
            </div>
        </div>
        </main>
        <script>
            var map = L.map('map').setView([ 25.814804966253973,  -108.97979860341567], 17);
            var circle = L.circle([25.814804966253973,  -108.97979860341567], {
                color: 'blue',
                fillColor: '#fff',
                fillOpacity: 0.3,
                radius: 100
            }).addTo(map)

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([25.814804966253973, -108.97979860341567]).addTo(map)
                .bindPopup('Vísitanos!!')
                .openPopup();
        </script>

        @include('layouts.footer')

        
    </body>
</html>