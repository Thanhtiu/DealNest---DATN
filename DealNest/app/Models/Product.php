<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\Product_image;
use App\Models\Product_attribute;
class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'seller_id',
        'category_id',
        'subcategory_id',
        'brand_id',
        'description',
        'price',
        'quantity',
        'favourite',
        'rating',
        'sales',
        'status',
        'note'
    ];

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }   

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }   
    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }   
    public function product_image(){
        return $this->hasMany(Product_image::class,'product_id');
    }
    public function product_attribute(){
        return $this->hasMany(Product_attribute::class,'product_id');
    }

    public function seller(){
        return $this->belongsTo(Seller::class,'seller_id');
    }
   
}
