<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
   protected $fillable = ['order_id', 'user_id', 'address', 'status', 'delivery_date'];

   // Relación con la orden
   public function order()
   {
      return $this->belongsTo(Sale::class);
   }


   // Relación con la tienda
   public function store()
   {
      return $this->belongsTo(Store::class);
   }

   // Relación con el repartidor
   public function user()
   {
      return $this->belongsTo(User::class);
   }
}
