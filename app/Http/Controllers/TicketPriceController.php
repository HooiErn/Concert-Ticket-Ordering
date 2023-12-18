<?php

namespace App\Http\Controllers;

use App\Models\Ticket_type;
use Illuminate\Http\Request;

class TicketPriceController extends Controller
{
    public function getTicketPrices($concertId)
    {
        $ticketPrices = Ticket_type::where('concert_id', $concertId)->pluck('price', 'name');

        return response()->json($ticketPrices);
    }
}