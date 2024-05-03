<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>REBU - @yield('titulo')</title>
        @vite('resources/css/app.css')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
            <div class="flex justify-center">
                <img class="w-80 mx-auto md:w-5/6 md:m-0" src="{{ asset('img/location.png') }}">
            </div>
    
            <h4 class="text-base font-semibold my-10">UAS CU</h4>
        </div>
        </main>


        <footer class="bg-orange-500 text-white">
            <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
                <nav class="flex flex-wrap justify-center -mx-5 -my-2">
                    <div class="px-5 py-2">
                        <a href="#" class="text-lg leading-6  hover:text-gray-900">
                            Sobre nosotros
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-lg leading-6  hover:text-gray-900">
                            Blog
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-lg leading-6  hover:text-gray-900">
                            Equipo
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-lg leading-6  hover:text-gray-900">
                            Precios
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="{{ route('contact.create')}}" class="text-lg leading-6  hover:text-gray-900">
                            Contacto
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-lg leading-6  hover:text-gray-900">
                            Terminos
                        </a>
                    </div>
                </nav>
                <div class="flex justify-center mt-8 space-x-6">
                    <a href="#" class="text-white hover:text-black">
                        <span class="sr-only">Facebook</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-black">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-white hover:text-black">
                        <span class="sr-only">Twitter</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                        </svg>
                    </a>
                </div>
                <p class="mt-8 text-base leading-6 text-center text-white border-t-2 py-2">
                    @php
                        $meses = array(
                        "enero", "febrero", "marzo", "abril", "mayo", "junio",
                        "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
                        );
                    @endphp


                    ©REBU - Todos los derechos reservados,
                    
                    {{now()->day}}
                    de
                    {{$meses[now()->month - 1]}}
                    del
                    {{now()->year}}
                </p>
            </div>
        </footer>
        
    </body>
</html>