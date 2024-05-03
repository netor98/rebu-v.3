<x-app-layout>

    
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-xl font-bold mb-4">Reportes</h1>
        <div class="relative">
            <button id="dropdownButton" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring flex items-center justify-center" onclick="toggleDropdown()">
                Ver Estadísticas &#x25BC
            </button>
            <div id="dropdownMenu" class="hidden absolute mt-1 w-48 bg-white shadow-lg rounded z-10">
                <a href="{{ route('reports.product_sales')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Productos más vendidos</a>
                <a href="{{ route('reports.least-sales')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Productos menos vendidos</a>
                <a href="{{ route('reports.most-revenue')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Productos que generan mas ingresos</a>
                <a href="{{ route('reports.least-revenue')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Productos que generan menos ingresos</a>
                <a href="{{ route('reports.top-buyers')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Clientes que compran más</a>
                <a href="{{ route('reports.top-revenue')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Clientes que compran más</a>
                <a href="{{ route('reports.by-date')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Rango de fecha</a>
                
            </div>
        </div>

        
        <h2 class="text-lg font-bold mb-4">Ventas por Rango de Fecha</h2>
        <form action="{{ route('reports.by-date') }}" method="GET" class="mb-4">
            <div class="flex mb-2">
                <div class="mr-2">
                    <label for="start_date">Fecha de Inicio:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>
                <div class="ml-2">
                    <label for="end_date">Fecha de Fin:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn bg-green-500 p-3 rounded-lg text-white">Buscar</button>
        </form>
        <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-8 py-4">Fecha</th>
                    <th class="border px-8 py-4">Total de Ventas</th>
                    <th class="border px-8 py-4">Cliente</th>
                    <th class="border px-8 py-4">Productos Comprados</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($salesByDateRange as $sale)
                    <tr>
                        <td class="border px-8 py-4">{{ $sale['date'] }}</td>
                        <td class="border px-8 py-4">${{ number_format($sale['total_sales'], 2) }}</td>
                        <td class="border px-8 py-4">{{ $sale['customer_name'] }}</td>
                        <td class="border px-8 py-4">{{ $sale['products'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border px-8 py-4 text-center">No hay ventas registradas para el rango de fechas especificado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $salesByDateRange->links() }}
        </div>
    </div>

        

    <script>
        function toggleDropdown() {
            var dropdownMenu = document.getElementById('dropdownMenu');
            if (dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.remove('hidden');
            } else {
                dropdownMenu.classList.add('hidden');
            }
        }
        window.onclick = function(event) {
            if (!event.target.matches('#dropdownButton')) {
                var dropdownMenus = document.querySelectorAll('#dropdownMenu');
                dropdownMenus.forEach(function(menu) {
                    if (!menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                    }
                });
            }
        }
    </script>


</x-app-layout>
    




    
