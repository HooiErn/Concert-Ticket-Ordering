<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'concert_name',
        'total amount',
        'payment_status',
    ];

    public function items()
    {
        return $this->hasMany(order_item::class, 'order_id', 'id');
    }
}
