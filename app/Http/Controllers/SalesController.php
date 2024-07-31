<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;


class SalesController extends Controller
{

   public function showPurchaseHistory()
   {
      // Obtener el ID del usuario autenticado
      $userId = Auth::id();

      // Recuperar las ventas asociadas al usuario
      $sales = Sale::where('user_id', $userId)
         ->with('items.product') // Cargar también los productos asociados a cada ítem de la venta
         ->orderBy('created_at', 'desc') // Ordenar por fecha de creación
         ->get();

      // Pasar las ventas a la vista
      return view('purchase_history', compact('sales'));
   }

   public function showHistoryById($userId)
   {
      // Recuperar las ventas asociadas al usuario
      $sales = Sale::where('user_id', $userId)
         ->with('items.product') // Cargar también los productos asociados a cada ítem de la venta
         ->orderBy('created_at', 'desc') // Ordenar por fecha de creación
         ->get();

      // Pasar las ventas a la vista
      return view('purchase_history', compact('sales'));
   }
}
