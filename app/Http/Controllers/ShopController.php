<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;


use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Store;
use Illuminate\Support\Facades\Session;


class ShopController extends Controller
{
   public function index()
   {
      $stores = Store::all();
      $products = Product::all();
      return view('dashboard', compact('products', 'stores'));
   }

   public function payment()
   {
      return view('payment');
   }

   public function deleteProduct(Request $request)
   {
      if ($request->id) {
         $cart = session()->get('cart');
         if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
         }
         session()->flash('success-delete', 'Producto eliminado correctamente');
      }
   }

   public function addProductToCart($id)
   {
      $product = Product::findOrFail($id);
      $cart = session()->get('cart', []);
      if (isset($cart[$id])) {
         $cart[$id]['cuantity']++;
      } else {
         $cart[$id] = [
            "name" => $product->name,
            "cuantity" => 1,
            "price" => $product->price,
            "image" => $product->image
         ];
      }
      session()->put('cart', $cart);
      return redirect()->back()->with('success', $product->name . ' ha sido agregado al carrito');
   }


   public function checkOut(Request $request)
   {
      $cart = session('cart');
      $quantities = $request->input('products', []);  // Default a un array vacío si no se encuentra nada

      if ($cart == null) {
         return redirect()->back()->with('no-products', 'No hay productos en el carrito');
      }

      $total = 0;
      $items = [];
      foreach ($cart as $id => $details) {
         $product = Product::find($id);
         if (!$product) {
            continue;  // Si el producto no existe, saltar este ítem
         }

         $newQuantity = $quantities[$id]['cuantity'] ?? $details['cuantity'];
         $newQuantity *= 1;
         if ($newQuantity  > $product->cuantity) {
            return redirect()->back()->with('error', 'No hay suficiente stock del producto ' . $product->name);
         }

         $product->cuantity -= $newQuantity;  // Reducir el stock del producto
         $product->save();

         $items[] = [
            'product_id' => $id,
            'quantity'   => $newQuantity,
            'price'      => $product->price,
            'total'      => $product->price * $newQuantity
         ];
         $total += $product->price * $newQuantity;
      }

      if (empty($items)) {
         return redirect()->back()->with('error', 'No hay productos válidos para procesar la compra');
      }

      // Crear la venta
      $sale = new Sale();
      $sale->user_id = auth()->id();
      $sale->total = $total;
      $sale->status = 0;  // 0 = 'Pendiente de pago

      $sale->save();

      $delivery = new Delivery();
      $delivery->sale_id = $sale->id;
      $delivery->user_id = auth()->id();
      $delivery->address = "Test";
      $delivery->store_id = $product->store_id;
      $delivery->delivery_agent_id = null; // Set this if you have a delivery agent, otherwise leave null
      $delivery->status = 0; // Default status, e.g., 0 = 'Pending'
      $delivery->delivery_date = null; // Set this if you have a delivery date, otherwise leave null
      $delivery->save();

      // Crear los ítems de la venta
      foreach ($items as $item) {
         $saleItem = new SaleItem($item);
         $sale->items()->save($saleItem);
      }

      session()->forget('cart');  // Limpiar el carrito después de procesar la compra

      return redirect()->route('payment')->with('checkout', 'Se ha realizado la compra con éxito');
   }
}
