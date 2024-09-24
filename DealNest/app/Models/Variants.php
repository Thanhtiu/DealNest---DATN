<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variants extends Model
{
    use HasFactory;
    protected $table = 'variants';

    protected $fillable = [
        'product_id',
        'type',
        'value',
    ];
    public function variantPrices()
    {
        return $this->hasMany(Variant_price::class, 'variant_id');
    }
}
