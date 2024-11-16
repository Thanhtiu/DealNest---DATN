<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'description',
        'classify'
    ];
    public function images()
    {
        return $this->hasMany(Review_image::class, 'review_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'product_id', 'product_id');
    }
}
