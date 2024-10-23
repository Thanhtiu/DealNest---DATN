<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\Product_image;
use App\Models\attribute_value;
use App\Models\Wishlist;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'seller_id',
        'category_id',
        'country_id',
        'slug',
        'description',
        'price',
        'mrp',
        'image',
        'quantity',
        'view',
        'sku',
        'sales',
        'trash_can',
        'note',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function product_image()
    {
        return $this->hasMany(Product_image::class, 'product_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
    public function attribute_values()
    {
        return $this->hasMany(attribute_value::class, 'product_id');
    }
    public function wishlist() {
        return $this->hasMany(Wishlist::class);
    }
}
