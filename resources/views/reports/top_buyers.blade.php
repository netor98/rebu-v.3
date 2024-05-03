<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        <div class="flex mt-8 gap-5">
            <div class="flex-1">
                <h2 class="text-lg font-bold mb-4">Tabla de Clientes que compran mas productos.</h2>
                <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-8 py-4">Nombre del Producto</th>
                            <th class="border px-8 py-4">Cantidad Comprada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topBuyers as $product)
                            <tr>
                                <td class="border px-8 py-4">{{ $product['name'] }}</td>
                                <td class="border px-8 py-4">{{ $product['total_items'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex-1">
                <h2 class="text-lg font-bold mb-4">Gráfico de Clientes que compran mas productos.</h2>
                <canvas id="topBuyersChart" width="400" height="250"></canvas>
            </div>
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

        function getRandomColor() {
            var r = Math.floor(Math.random() * 256); // Rojo 0-255
            var g = Math.floor(Math.random() * 256); // Verde 0-255
            var b = Math.floor(Math.random() * 256); // Azul 0-255
            return `rgba(${r}, ${g}, ${b}, 0.5)`; // Modifica la opacidad si es necesario
        }
    </script>

    <script>
        var topBuyersCtx = document.getElementById('topBuyersChart').getContext('2d');
        var topBuyersData = @json($topBuyers);

        new Chart(topBuyersCtx, {
            type: 'bar',
            data: {
                labels: topBuyersData.map(data => data.name),
                datasets: [{
                    label: 'Unidades vendidas',
                    data: topBuyersData.map(data => data.total_items),
                    backgroundColor: topBuyersData.map(() => getRandomColor()), // Genera un color para cada barra
                    borderColor: topBuyersData.map(() => getRandomColor()), // Opcional: puedes usar un solo color para todos los bordes si prefieres
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
