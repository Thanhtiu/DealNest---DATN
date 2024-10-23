<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'status',
        'image',
        'status',
        'parent_id',
        'slug'
    ];

    public function products()
    {
        return $this->hasManyThrough(Product::class, SubCategory::class, 'category_id', 'subcategory_id');
    }

     // Quan hệ với danh mục cha
     public function parent()
     {
         return $this->belongsTo(Category::class, 'parent_id');
     }
 
     // Quan hệ với danh mục con
     public function children()
     {
         return $this->hasMany(Category::class, 'parent_id');
     }


}