<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-4">Historial de Compras</h1>
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                            ID de Venta
                        </th>
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                            Fecha
                        </th>
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                            Detalles de Productos
                        </th>
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr>
                            <td class="px-3 py-4 border-b border-gray-200 bg-white">{{ $sale->id }}</td>
                            <td class="px-3 py-4 border-b border-gray-200 bg-white">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-3 py-4 border-b border-gray-200 bg-white">
                                <ul>
                                    @foreach ($sale->items as $item)
                                        <li>{{ $item->product->name }} - {{ $item->quantity }} unidades a ${{ number_format($item->price, 2) }} c/u</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-3 py-4 border-b border-gray-200 bg-white">${{ number_format($sale->total, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No hay compras registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
