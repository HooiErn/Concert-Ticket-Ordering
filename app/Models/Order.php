<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'username',
        'concert_name',
        'order_date',
        'total_amount',
        'payment_status',
    ];

    public function items()
    {
        return $this->hasMany(order_item::class, 'order_id', 'id');
    }
}
