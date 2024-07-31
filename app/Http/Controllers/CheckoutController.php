<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
   //
   public function showCheckoutForm()
   {
      $lastSale = Sale::where('user_id', auth()->id())->latest()->first();

      return view('cart', ['lastSale' => $lastSale]);
   }
}
