<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_item extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'concert_id',
        'concert_name',
        'seat_quantity',
        'seat_number',
        'total_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
