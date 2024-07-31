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

           @if(session('delivery'))
               <div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50" role="alert">
                   <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                       <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                   </svg>
                   <div class="ms-3 text-sm font-medium">
                       {{ session('success') }}
                   </div>
               </div>  
           @endif

           @if(session('error'))
               <div id="alert-border-3" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50" role="alert">
                   <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                       <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                   </svg>
                   <div class="ms-3 text-sm font-medium">
                       {{ session('error') }}
                   </div>
               </div>  
           @endif

           <h3 class="text-center text-2xl uppercase font-bold mb-5">Repartos</h3>
           
           <div class="container pt-16">
              @if ($deliveries->count() == 0)
                  <div class="text-center">
                      <p class="text-gray-600">No hay repartos pendientes.</p>
                  </div>

               @else
               @foreach($deliveries as $delivery)
               @if($delivery->status == 0)
                  <div class="flex justify-between border border-gray-200 rounded-lg max-w-3xl mx-auto mb-4">
                        <div class="p-4">
                           <h3 class="font-medium">Orden: {{ $delivery->sale_id }}</h3>
                           @if($delivery->store)
                              <p class="text-gray-600">Tienda: {{ $delivery->store->name }}</p>
                           @else
                              <p class="text-gray-600">Tienda: No asignada</p>
                           @endif
                           <p class="text-gray-600">Usuario: {{ $delivery->user->username }}</p>
                           <p class="text-gray-600">Estado: 
                              @if($delivery->status == 0)
                                    Pendiente
                              @elseif($delivery->status == 1)
                                    En entrega
                              @elseif ($delivery->status == 2)
                                    Entregado
                              @endif
                           </p>
                           <button onclick="location.href='{{ route('delivery.details', ['id' => $delivery->id]) }}'" class="text-white px-4 py-2 rounded-full mt-2" style="background-color: #B67352">Ver detalles</button>

                           @if($delivery->status == 1)
                               <form action="{{ route('delivery.updateStatus', $delivery->id) }}" method="POST" class="mt-4">
                                   @csrf
                                   @method('PUT')
                                   <input type="hidden" name="status" value="2">
                                   <button type="submit" class="text-white px-4 py-2 rounded-full mt-2" style="background-color: #B67352">Marcar como Entregado</button>
                               </form>
                           @endif
                        </div>
                        <div id="map-{{ $delivery->id }}" style="height: 300px; width: 450px" class="border-gray-200"></div>
                  </div>
                 
               @endif
            @endforeach

              @endif

              

           </div>
       </div>
   </div>
</x-app-layout>

@include('layouts.footer')

<script src="/js/searcher.js"></script>

@if ($deliveries->count() > 0)
<script>
   document.addEventListener('DOMContentLoaded', function () {
       @foreach($deliveries as $delivery)
           @if($delivery->store)
               var mapContainerId = 'map-{{ $delivery->id }}';
               if (document.getElementById(mapContainerId)) {
                   // Initialize the map for each delivery
                   var map{{ $delivery->id }} = L.map(mapContainerId).setView([{{ $delivery->store->latitude }}, {{ $delivery->store->longitude }}], 13);

                   // Add tile layer to the map
                   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                       attribution: '© OpenStreetMap contributors'
                   }).addTo(map{{ $delivery->id }});

                   // Add markers to the map
                   var storeMarker = L.marker([{{ $delivery->store->latitude }}, {{ $delivery->store->longitude }}])
                       .addTo(map{{ $delivery->id }})
                       .bindPopup('<b>{{ $delivery->store->name }}</b><br>{{ $delivery->address }}');

                   var userIcon = L.icon({
                       iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                       shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                       iconSize: [25, 41],
                       iconAnchor: [12, 41],
                       popupAnchor: [1, -34],
                       shadowSize: [41, 41]
                   });

                   var userMarker = L.marker([{{ $delivery->latitude}}, {{ $delivery->longitude }}], {
                       icon: userIcon
                   }).addTo(map{{ $delivery->id }})
                     .bindPopup('<b>{{ $delivery->user->username }}</b><br>{{ $delivery->address }}</br>');

                   // Add routing control to calculate and display the route
                   var routingControl = L.Routing.control({
                       waypoints: [
                           L.latLng({{ $delivery->store->latitude }}, {{ $delivery->store->longitude }}),
                           L.latLng({{ $delivery->latitude}}, {{ $delivery->longitude }})
                       ],
                       draggableWaypoints: false,
                       show: false,
                       addWaypoints: false
                   }).addTo(map{{ $delivery->id }});

                   routingControl.on('routesfound', function(e) {
                       var distance = e.routes[0].summary.totalDistance;
                       var distanceKm = (distance / 1000).toFixed(2);
                       userMarker.bindPopup('<b>{{ $delivery->user->username }}</b><br>{{ $delivery->address }}</br><br>Distance: ' + distanceKm + ' km').openPopup();
                   });
               }
           @endif
       @endforeach
   });
</script>
@endif
