<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;

class DeliveryController extends Controller
{
   public function index()
   {
      $deliveries = Delivery::with('store')->where('status', 0)->get(); // Cargar la relación 'store'

      return view('delivery.index', compact('deliveries'));
   }

   public function assignAgent($id, $agent_id)
   {
      $delivery = Delivery::find($id);
      if ($delivery) {
         $delivery->delivery_agent_id = $agent_id;
         $delivery->status = 1;
         $delivery->save();

         return redirect()->route('delivery.index')->with('success', 'Entrega asignada correctamente.');
      }

      return redirect()->back()->with('error', 'Delivery not found.');
   }

   public function showDetails($id)
   {
      $delivery = Delivery::find($id);
      $agent_id = auth()->user()->id; // Assuming the agent is logged in
      $qrCodeUrl = route('assign.agent', ['id' => $delivery->id, 'agent_id' => $agent_id]);

      return view('delivery.details', compact('delivery', 'qrCodeUrl'));
   }

   public function agentDeliveries()
   {
      $agent_id = auth()->user()->id; // Get the logged-in delivery agent's ID
      $deliveries = Delivery::where('delivery_agent_id', $agent_id)
         // Assuming you only want to show pending deliveries
         ->get();

      return view('delivery.agent', compact('deliveries'));
   }

   public function updateStatus(Request $request, $id)
   {
      $delivery = Delivery::find($id);
      if ($delivery) {
         $delivery->status = $request->status;
         $delivery->save();

         return redirect()->route('delivery.index')->with('success', 'Entrega finalizada correctamente.');
      }

      return redirect()->back()->with('error', 'Delivery not found.');
   }
}
