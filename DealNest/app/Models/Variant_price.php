<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Variants;
class Variant_price extends Model
{
    use HasFactory;

    protected $table = 'variant_price';

    protected $fillable = [
        'variant_id',
        'price',
    ];
    public function variant()
    {
        return $this->belongsTo(Variants::class);
    }
}
