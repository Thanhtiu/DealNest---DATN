<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Product;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'Subcategories';

    protected $fillable = [
        'name',
        'category_id',
        'status',
        'url',
        'slug'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }
    
    
}
