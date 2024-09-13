<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\Attribute;
class Product_attribute extends Model
{
    use HasFactory;
    protected $table = 'product_attributes';
    protected $fillable = [
        'product_id',
        'attribute_id',
        'value',
    ];
    public function attribute() {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}