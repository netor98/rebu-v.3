<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Delivery;

class AddressController extends Controller
{
   public function saveAddress(Request $request)
   {
      $request->validate([
         'latitude' => 'required|numeric',
         'longitude' => 'required|numeric',
      ]);

      // Retrieve the last delivery record
      $lastDelivery = Delivery::latest()->first();

      if ($lastDelivery) {
         $lastDelivery->latitude = $request->latitude;
         $lastDelivery->longitude = $request->longitude;
         $lastDelivery->save();
      }

      return redirect()->route('shop')->with('checkout', 'Se ha realizado la compra con éxito');
   }
}
