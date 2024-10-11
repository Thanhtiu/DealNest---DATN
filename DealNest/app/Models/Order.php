<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    // Danh sách các trường có thể được gán giá trị
    protected $fillable = [
        'user_id',
        'seller_id',
        'status',
        'total',
        'delivery_date',
        'payment_method',
        'payment_status',
        'name','phone','address',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
