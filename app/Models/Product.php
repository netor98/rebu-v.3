<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cuantity',
        'description',
        'image',
        'price',
        'active',
        'store_id'
    ];

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
        
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    
}
