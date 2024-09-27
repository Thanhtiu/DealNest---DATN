<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute;
use App\Models\Cart;

class Cart_item extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'attribute_id',
        'value',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    
}
