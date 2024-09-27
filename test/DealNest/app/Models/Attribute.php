<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\attribute_value;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attributes';
    protected $fillable = [
        'name',
    ];
    public function attributeValues()
    {
        return $this->hasMany(attribute_value::class);
    }
}
