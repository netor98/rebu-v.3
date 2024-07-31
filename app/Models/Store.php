<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
   use HasFactory;

   protected $fillable = ['name', 'address', 'latitude', 'longitude'];

   public function products()
   {
      return $this->hasMany(Product::class);
   }

   public function deliveries()
   {
      return $this->hasMany(Delivery::class);
   }
}
