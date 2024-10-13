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
        'name',
        'phone',
        'address',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function pendingOrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id')->where('status', 'pending');
    }

    public function waitingForDeliveryOrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id')->where('status', 'waiting_for_delivery');
    }
    public function cancelOrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id')->where('status', 'cancel');
    }

    public function buyerCancelOrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id')->where('status', 'buyer_cancel');
    }

    public function successOrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id')->where('status', 'success');
    }
}
