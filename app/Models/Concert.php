<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'date_time',
        'venue',
        'images',
        'description',
        'organizer_name',
    ];

     // Define the relationship with TicketType
    public function sortedTicketTypes()
    {
        return $this->hasMany(Ticket_type::class)->orderBy('price', 'asc');
    }
}
