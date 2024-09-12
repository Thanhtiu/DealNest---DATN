<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Product_image;
class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'product_id',
        'quantity',
        'user_id',
        'total_price',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function product_image(){
        return $this->hasMany(Product_image::class,'product_id');
    }

}
