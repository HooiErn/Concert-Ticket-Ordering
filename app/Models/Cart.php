<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_name',
        'concert_id',
        'concert_name',
        'seat_number',
        'seat_quantity',
        'total_price',
    ];
}
