<x-app-layout>
    
    <div class="">
        @if(session('success'))
            <div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
                    
                </div>
                
            </div>  
        @endif
    
        @if(session('checkout'))
        <div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ session('checkout') }}
                
            </div>
            
        </div>  
        @endif


        
        <div class="container p-16 mx-auto">
            @if(session('success-delete'))
    
            <div id="alert-border-1" class="flex items-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success-delete') }}
    
                    </div>
                    
                </div>
            @endif  

            @if(session('no-products'))
            <div id="alert-border-3" class="flex items-center p-4 mb-4 bg-red-500 border-t-4  text-white" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ session('no-products') }}
                    
                </div>
                
            </div>
            @endif
    
            @if(session('error'))
                <div id="alert-border-2" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        {{session('error')}}
    
                    </div>
                    
                </div>
            @endif
    
            
       
    
            <h2 class="text-2xl font-semibold mb-4">Productos</h2>
            
            <!-- Cart items -->
            <form method="POST" action="{{route('checkout')}}">
                @csrf
    
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    
                @php
                    $total = 0;
                @endphp
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
    
                        <div class="border rounded-lg p-4">
                            <div class="flex items-center justify-between gap-2">
                                <img src="{{ asset('storage/public/uploads') }}/{{ $details['image'] }}" alt="Product Image" class="w-16 h-16 object-cover">
                                <div class="ml-4">
                                    <h3 class="font-semibold">{{ $details['name']}}</h3>
                                </div>
                                <div>
                                    <input type="number" name="products[{{ $id }}][cuantity]" class="form-input border-2 rounded-md border-gray-400 w-16 text-center" value="{{$details['cuantity']}}" min="1">

                                </div>
                                @php
                                    $total += $details['cuantity'] * $details['price']
                                @endphp
                                <div>
                                    <span class="font-semibold">${{ $details['price'] }}</span>
                                </div>
                                <div id="{{ $id }}">
                                    <button class="text-red-400  hover:text-red-700 flex items-center delete-product">
                                        <svg class="w-8 h-8" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                            <path d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        
                    @endforeach
                @endif
    
            </div>
            <div class="mt-8">
                <div class="flex justify-between items-center border-t pt-4">
                    <span class="text-lg font-semibold">Total:</span>
                    <span class="text-lg font-semibold">${{$total}}</span>
                </div>
                <div class="mt-4">
                    <button type="submit"  class="bg-sky-400 text-white font-semibold px-6 py-3 rounded hover:bg-blue-700 transition-all">Realizar compra</button>
                </div>
            </div>
        </form>
        <script type="text/javascript">
            $(".delete-product").click(function (e) {
                e.preventDefault();
        
                var ele = $(this);
        
                if (confirm("Quieres eliminar el producto?")) {
                    $.ajax({
                        url: '{{route('delete.cart.product')}}',
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}', 
                            id: ele.parents("div").attr("id")
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    })
                }
            })
        </script>
            
</x-app-layout>

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
                <a href="#" class="text-lg leading-6  hover:text-gray-900">
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

