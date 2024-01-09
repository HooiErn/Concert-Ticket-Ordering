<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Ticket;

class TicketController extends Controller
{
   public function downloadTicketPdf($ticketId)
    {
       // Retrieve ticket information based on $ticketId
        $ticket = Ticket::with(['concert', 'user'])->find($ticketId);

        // Generate PDF using the ticket information and the PDF view
        $pdf = PDF::loadView('frontend.ticket', compact('ticket'));

        // Display the live PDF view
        return $pdf->stream('ticket_verification.pdf');
        // Download the PDF file
        return $pdf->download('ticket_verification.pdf');
    }
}
