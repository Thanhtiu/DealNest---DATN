<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review_image extends Model
{
    use HasFactory;

    protected $table = 'review_images';

    protected $fillable = [
        'review_id',
        'image',
    ];
    public function review()
{
    return $this->belongsTo(Review::class, 'review_id');
}
}
