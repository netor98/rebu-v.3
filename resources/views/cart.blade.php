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
    
            <div id="alert-border-3" class="flex items-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50" role="alert">
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
                <div id="alert-border-3" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50" role="alert">
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

@include('layouts.footer')