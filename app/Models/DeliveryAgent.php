<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAgent extends Model
{
   use HasFactory;

   public function deliveries()
   {
      return $this->hasMany(Sale::class);
   }
}
