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
        'address_id',
        'name',
        'description',
        'join',
        'store_email',
        'store_phone',
        'logo',
        'background',
        'note',
        'status',
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
