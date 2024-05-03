<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;


use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\Session;


class ShopController extends Controller
{
    public function index() {
        $products = Product::where('active', 1)->simplePaginate(2);
        return view('dashboard', compact('products'));
    }
    
    public function deleteProduct(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Producto eliminado correctamente');
        }
    }

    public function addProductToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
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


    public function checkOut(Request $request) {
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
        $sale->save();
    
        // Crear los ítems de la venta
        foreach ($items as $item) {
            $saleItem = new SaleItem($item);
            $sale->items()->save($saleItem);
        }
    
        session()->forget('cart');  // Limpiar el carrito después de procesar la compra
    
        return redirect()->route('shop')->with('checkout', 'Se ha realizado la compra con éxito');
    }
    
    
    
}
