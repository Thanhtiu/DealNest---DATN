<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $fillable = [
        'product_id',
        'seller_id',
        'name',
        'code',
        'type',
        'value',
        'start_date',
        'end_date',
        'status',
    ];

   
}
