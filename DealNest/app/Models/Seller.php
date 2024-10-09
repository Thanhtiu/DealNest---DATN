<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Adress;

class Seller extends Model
{
    use HasFactory;
    protected $table = 'sellers';
    protected $fillable = [
        'user_id',
        'store_name',
        'store_description',
        'rating',
        'follow',
        'join',
        'store_phone',
        'store_email',
        'address_id',
        'status',
        'note'
    ];
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }
    public function totalSales()
    {
        return $this->products()->sum('sales');
    }
}
