<x-app-layout>
   <section class="py-8 antialiased dark:bg-gray-900">
       <div class="mx-auto px-4 2xl:px-0">
           <div class="mx-auto max-w-5xl">
               <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Mis Entregas</h2>

               @foreach($deliveries as $delivery)
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

                           @if($delivery->status == 1)
                               <form action="{{ route('deliveries.updateStatus', $delivery->id) }}" method="POST" class="mt-4">
                                   @csrf
                                   @method('PUT')
                                   <input type="hidden" name="status" value="2">
                                   <button type="submit" class="text-white px-4 py-2 rounded-full mt-2" style="background-color: #B67352">Marcar como Entregado</button>
                               </form>
                           @endif
                       </div>
                       <div id="map-{{ $delivery->id }}" style="height: 300px; width: 450px" class="border-gray-200"></div>
                   </div>
               @endforeach
           </div>
       </div>
   </section>
</x-app-layout>
@if ($deliveries->count() > 0)
<script>
   document.addEventListener('DOMContentLoaded', function () {
       @foreach($deliveries as $delivery)
           @if($delivery->store)
               // Initialize the map for each delivery
               var map{{ $delivery->id }} = L.map('map-{{ $delivery->id }}').setView([{{ $delivery->store->latitude }}, {{ $delivery->store->longitude }}], 13); 

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
           @endif
       @endforeach
   });
</script>
@endif

@include('layouts.footer')
