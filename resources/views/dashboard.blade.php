<x-app-layout>
    <div>
        <div class="container p-16 mx-auto">
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
            <h3 class="text-center text-2xl uppercase font-bold mb-5">Bienvenido, {{auth()->user()->username}} 😀</h3>
            
            <!--Categorias-->
            
        
            <!--Productos-->
            <div class="container pt-16">
                @foreach($stores as $store)
                <div class="lg:flex justify-between items-center my-4">
                       
                        <div>
                            <h3 class="font-medium">{{ $store->name }}</h3>
                            <p class="text-gray-600 mt-2">Compra postres y snakcs de distintas tiendas online a los mejores precios</p>
                            
                        </div>
                        
                        <div class="space-x-4 mt-8 lg:mt-0">
                            <button class="text-white px-4 py-1 rounded-full"
                                style="background-color: #B67352">{{ $store->address }}</button>
                        </div>
                    
                </div>

                <div class="swiper-container swiper-container-{{ $store->id }} mb-10 border-b">
                    <div class="swiper-wrapper">
                        @foreach($products as $product)
                            @if ($product->active == 1 && $product->store_id == $store->id)
                                <div class="swiper-slide p-4 flex justify-center items-center">
                                    <div class="border border-gray-200 hover:border-gray-300 hover:scale-105 transition-transform rounded-lg relative p-3 bg-white w-full max-w-xs">
                                        <img src="{{ asset('storage/public/uploads/' . $product->image) }}" alt="{{ $product->name }}" class="h-36 w-full object-cover rounded-t-lg">
                                        <h3 class="font-medium name mt-4">{{ $product->name }}</h3>
                                        <h3 class="text-2xl font-medium text-red-600 mt-2">${{ $product->price }}</h3>
                                        <a href="{{ route('add.to.cart', $product->id) }}" class="absolute bottom-3 right-2 text-white rounded-full grid place-items-center cursor-pointer text-[28px] w-[40px] h-[40px]" style="background-color: #B67352">
                                            <svg class="text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="swiper-pagination-{{ $store->id }}"></div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>

@include('layouts.footer')

<script src="/js/searcher.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
       const searcher = document.getElementById('searcher');
       searcher.addEventListener('input', function () {
           const query = searcher.value.toLowerCase();
           const products = document.querySelectorAll('.swiper-slide');

           products.forEach(product => {
               const productName = product.querySelector('.name').textContent.toLowerCase();
               if (productName.includes(query)) {
                   product.style.display = 'flex';
               } else {
                   product.style.display = 'none';
               }
           });
       });

       @foreach($stores as $store)
       new Swiper('.swiper-container-{{ $store->id }}', {
           slidesPerView: 1,
           spaceBetween: 10,
           breakpoints: {
               640: {
                   slidesPerView: 2,
                   spaceBetween: 1,
               },
               768: {
                   slidesPerView: 3,
                   spaceBetween: 1,
               },
               1024: {
                   slidesPerView: 4,
                   spaceBetween: 1,
               },
           },
           pagination: {
               el: '.swiper-pagination-{{ $store->id }}',
               clickable: true,
           },
           navigation: {
               nextEl: '.swiper-button-next-{{ $store->id }}',
               prevEl: '.swiper-button-prev-{{ $store->id }}',
           },
       });
       @endforeach

       // Elimina el elemento de alerta después de 3 segundos
       const alert = document.getElementById('alert-border-3');
       if (alert) {
           setTimeout(() => {
               alert.remove();
           }, 3000);
       }
   });
</script>

</script>
