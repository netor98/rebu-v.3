<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Sale;


class ReportController extends Controller
{
    // Método para obtener los productos más y menos vendidos
    public function productSales() {

        if(auth()->user()->id != 1) {
            return redirect('shop');
        }


        $mostSoldProducts = Product::with(['saleItems'])
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->name,
                    'count' => $product->saleItems->sum('quantity') // Suma de cantidad de todos los saleItems
                ];
            })
            ->sortByDesc('count') // Ordena los productos por cantidad vendida de manera descendente
            ->take(5);

       
    
        return view('reports.product_sales', compact('mostSoldProducts'));

    }

    public function leastSales(){
        // Productos menos vendidos
        $leastSoldProducts = Product::withCount('saleItems')
            ->orderBy('sale_items_count', 'asc')
            ->take(5)
            ->get()
            ->map(function ($product) {
                return ['name' => $product->name, 'count' => $product->sale_items_count];
            });


        return view('reports.least_sales', compact('leastSoldProducts'));
    }

    public function mostRevenue() {
        if(auth()->user()->id != 1) {
            return redirect('shop');
        }

        // Productos que generan más ingresos, ordenados correctamente
        $mostRevenueProducts = Product::query()
            ->with(['saleItems' => function($query) {
                $query->selectRaw('product_id, SUM(price * quantity) as revenue')
                      ->groupBy('product_id');
            }])
            ->get()
            ->map(function ($product) {
                // Calcula el total de ingresos para cada producto
                $revenue = $product->saleItems->sum(function($saleItem) {
                    return $saleItem->revenue; // Asegúrate de que 'revenue' esté disponible como atributo calculado
                });
                return ['name' => $product->name, 'revenue' => $revenue];
            })
            ->sortByDesc('revenue')  // Ordena los productos por ingresos, de mayor a menor
            ->values();  // Resetea las claves del array para la paginación o retorno JSON
    
        return view('reports.most_revenue', compact('mostRevenueProducts'));
    }


    public function leastRevenue() {
        if(auth()->user()->id != 1) {
            return redirect('shop');
        }

        // Productos que generan menos ingresos, ordenados correctamente
        $leastRevenueProducts = Product::query()
            ->with(['saleItems' => function($query) {
                $query->selectRaw('product_id, SUM(price * quantity) as revenue')
                      ->groupBy('product_id');
            }])
            ->get()
            ->map(function ($product) {
                // Calcula el total de ingresos para cada producto
                $revenue = $product->saleItems->sum(function($saleItem) {
                    return $saleItem->revenue; // Asegúrate de que 'revenue' esté disponible como atributo calculado
                });
                return ['name' => $product->name, 'revenue' => $revenue];
            })
            ->sortBy('revenue')  // Ordena los productos por ingresos, de menor a mayor
            ->values();          // Resetea las claves del array para la paginación o retorno JSON
    
        return view('reports.least_revenue', compact('leastRevenueProducts'));
    }

    public function topBuyers() {
        if(auth()->user()->id != 1) {
            return redirect('shop');
        }

        $topBuyers = User::with(['sales.saleItems']) // Asegura que esta relación está ahora disponible
            ->get()
            ->map(function ($user) {
                $totalItems = $user->sales->reduce(function ($carry, $sale) {
                    return $carry + $sale->saleItems->sum('quantity'); // Suma la cantidad de cada item de venta
                }, 0);
    
                return [
                    'name' => $user->username,
                    'total_items' => $totalItems
                ];
            })
            ->sortByDesc('total_items')
            ->values();
            
        return view('reports.top_buyers', compact('topBuyers'));
    }
    

    public function topRevenueCustomers() {
        if(auth()->user()->id != 1) {
            return redirect('shop');
        }

        // Clientes que generan más ingresos
        $topRevenueCustomers = User::with('sales') // Pre-carga las ventas asociadas a cada usuario
            ->get()
            ->map(function ($user) {
                $totalRevenue = $user->sales->sum('total'); // Suma el total de todas las ventas para cada usuario
    
                return [
                    'name' => $user->username, // Nombre del usuario
                    'total_revenue' => $totalRevenue // Total de ingresos generados por el usuario
                ];
            })
            ->sortByDesc('total_revenue') // Ordena los usuarios por el total de ingresos, de mayor a menor
            ->values(); // Resetea las claves del array para la paginación o retorno JSON
    
        return view('reports.top_revenue', compact('topRevenueCustomers'));
    }
    
    
    public function salesByDateRange(Request $request) {
        if(auth()->user()->id != 1) {
            return redirect('shop');
        }

        $startDate = $request->start_date; // Formato esperado: 'YYYY-MM-DD'
        $endDate = $request->end_date;     // Formato esperado: 'YYYY-MM-DD'
    
        // // Asegúrate de que las fechas están presentes
        // if (!$startDate || !$endDate) {
        //     return back()->with('error', 'Es necesario especificar un rango de fechas.');
        // }
    
        // Consulta las ventas dentro del rango de fechas
        $salesByDateRange = Sale::whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])
                ->with(['user', 'saleItems.product']) // Carga las relaciones necesarias
                ->paginate(3)// Pagina los resultados
                ->through(function ($sale) {
                    return [
                        'date' => $sale->created_at->format('Y-m-d'),
                        'total_sales' => $sale->total,
                        'customer_name' => $sale->user->name, // Asume que tu modelo User tiene un campo 'name'
                        'products' => $sale->saleItems->map(function ($item) {
                            return $item->product->name . ' (x' . $item->quantity . ')'; // Asume que los productos tienen 'name' y los saleItems tienen 'quantity'
                        })->implode(', ')
                    ];
        })                
        ->appends(['start_date' => $startDate, 'end_date' => $endDate]); // Asegura que los parámetros se mantengan

        return view('reports.sales_by_date_range', compact('salesByDateRange'));
    }
    


}