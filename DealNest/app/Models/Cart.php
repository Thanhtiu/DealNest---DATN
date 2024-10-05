<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart_item;
use App\Models\Product;


class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'total_price',
        'quantity',
        'discount',
    ];

    public function items()
    {
        return $this->hasMany(Cart_item::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}


