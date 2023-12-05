<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;
    protected $fillable = [
        'concert_name',
        'date_time',
        'venue',
        'concert_image',
        'ticket_price',
        'description',
        'organizer_name',
        'organizer_contact_number'
    ];
}
