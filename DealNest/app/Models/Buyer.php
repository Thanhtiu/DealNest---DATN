<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $table = 'buyers';
    protected $fillable = [
        'user_id',
        'seller_follow_id',
    ];
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_follow_id');
    }
}
