<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\Product_image;
// use App\Models\Wishlist;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'seller_id',
        'category_id',
        'country_id',
        'name',
        'slug',
        'price',
        'mrp',
        'image',
        'description',
        'quantity',
        'view',
        'sales',
        'status',
        'transh_can',
        'note'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function product_image()
    {
        return $this->hasMany(Product_image::class, 'product_id');
    }

    public function parentCategory()
    {
        return $this->hasOneThrough(Category::class, Category::class, 'id', 'id', 'category_id', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id')->with('parent');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    // public function wishlist() {
    //     return $this->hasMany(Wishlist::class);
    // }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}
