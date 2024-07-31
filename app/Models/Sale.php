<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function items()
   {
      return $this->hasMany(SaleItem::class);
   }

   public function saleItems()
   {
      return $this->hasMany(SaleItem::class); // Asume que la clase del ítem de venta es 'SaleItem'
   }

   public function delivery()
   {
      return $this->hasOne(Delivery::class);
   }

   public function store()
   {
      return $this->belongsTo(Store::class);
   }

   public function deliveryAgent()
   {
      return $this->belongsTo(DeliveryAgent::class);
   }
}
