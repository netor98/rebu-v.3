<x-app-layout>
   <section class="py-8 antialiased dark:bg-gray-900">
       <div class="mx-auto px-4 2xl:px-0">
           <div class="mx-auto max-w-5xl">
               <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Detalles de la Entrega</h2>

               <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12">
                   <div class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-md dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:max-w-xl lg:p-8">
                       <h3 class="font-medium">Orden: {{ $delivery->sale_id }}</h3>
                       <p class="text-gray-600">Tienda: {{ $delivery->store->name }}</p>
                       <p class="text-gray-600">Estado: 
                           @if($delivery->status == 0)
                               Pendiente
                           @elseif($delivery->status == 1)
                               Entregado
                           @else
                               Desconocido
                           @endif
                       </p>

                       <div class="mt-4">
                           <p class="text-gray-600">Escanea este código QR para asignar esta entrega:</p>
                           {!! QrCode::size(250)->generate($qrCodeUrl) !!}
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>
</x-app-layout>
