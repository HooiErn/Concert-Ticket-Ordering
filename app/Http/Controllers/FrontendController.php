<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Ticket_type;
use App\Models\Order;
use App\Models\Concert;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;

class FrontendController extends Controller
{
    public function home()
    {

        $concerts = Concert::all();
         // getting concert price
        foreach ($concerts as $concert) {
            $concert->ticketTypes = Ticket_type::where('concert_id', $concert->id)->get();
            $concert->sortedTicketTypes = $concert->ticketTypes->sortBy('price');
        }


        return view('frontend.main',compact('concerts'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function event()
    {
        return view('frontend.event');
    }

    public function viewConcert($id){

        $concerts = Concert::find($id);

        return view('frontend.viewConcert',compact('concerts'));
    }

    public function bookingConcert($id){

        $concerts_id = Concert::find($id);

        return view('frontend.booking',compact('concerts_id'));
    }

    public function booking(){

        return view('frontend.booking');
    }

    // Add similar methods for other views as needed
}
