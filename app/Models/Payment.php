<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_method',
        'payment date',
        'payment_amount',
        'payment_status',
        'order_id',
        'description',
    ];
}
