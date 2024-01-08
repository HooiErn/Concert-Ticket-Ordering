<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'concert_id',
        'concert_name',
        'ticket_type',
        'ticket_price',
        'seat_number',
    ];

     // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function concert()
    {
        return $this->belongsTo(Concert::class, 'concert_id');
    }
}
