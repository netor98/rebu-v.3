<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow-md ">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('shop') }}">
                        <x-application-logo class="text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
                        {{ __('Tienda') }}
                    </x-nav-link>

                @if(auth()->user()->id == 1)
                
                    <x-nav-link :href="route('admin.messages')" :active="request()->routeIs('admin.messages')">
                        {{ __('Mensajes') }}
                    </x-nav-link>
                @endif

                   
                </div>
            </div>
            <div class="relative w-full max-w-[300px]  hidden md:max-w-[550px] md:block">
                <input class="bg-gray-100 border-none outline-none px-3 py-3 rounded-[30px] w-full"
                    type="text"
                    placeholder="Buscar producto..."
                    id="searcher">
                <svg class="absolute top-0 right-0 mt-3 mr-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
                      
                
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                @if(auth()->user()->id == 1)
                    <li class="list-none mx-5">
                        <a href="{{ route('admin') }}" >
                            <div class="text-black shadow-lg rounded-full p-2 hover:bg-gray-200">
                                <svg class=""  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 6c0 1.657-3.134 3-7 3S5 7.657 5 6m14 0c0-1.657-3.134-3-7-3S5 4.343 5 6m14 0v6M5 6v6m0 0c0 1.657 3.134 3 7 3s7-1.343 7-3M5 12v6c0 1.657 3.134 3 7 3s7-1.343 7-3v-6"/>
                                </svg>
                            </div>
                        </a>
                    </li>
                @endif
                <li class="relative list-none mr-5">
                    <a href="{{ route('details') }}" class="text-black block shadow-lg rounded-full p-2 hover:bg-gray-200 cursor-pointer" id="shop-cart">
                        <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg>
                    </a>

                   

                    <div class="absolute bg-red-600 text-white text-base -top-1 -right-1 rounded-full grid place-items-center w-[15px]"
                        id="counter-products">
                        {{count((array) session('cart'))}}
                    </div>
                      
                </li>

               
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->username }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('purchase.history')">
                            {{ __('Historial compras') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        @if(auth()->user()->id == 1)
                            <x-dropdown-link :href="route('reports.product_sales')">
                                {{ __('Reportes') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('admin.users')">
                                {{ __('Gestión usuarios') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('admin.sales')">
                                {{ __('Ventas por usuarios') }}
                            </x-dropdown-link>
                        @endif

                      

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
