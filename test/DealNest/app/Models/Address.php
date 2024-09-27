<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Address extends Model
{
    use HasFactory;
    protected $table = 'address';
    protected $fillable = [
        'user_id',
        'province_id',
        'district_id',
        'ward_id',
        'street',
        'string_address',
        'active',
    ];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
