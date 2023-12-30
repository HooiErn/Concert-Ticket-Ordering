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
use App\Models\Seat;
use App\Models\Cart;
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

    public function concert()
    {
        $concerts = Concert::all();
         // getting concert price
        foreach ($concerts as $concert) {
            $concert->ticketTypes = Ticket_type::where('concert_id', $concert->id)->get();
            $concert->sortedTicketTypes = $concert->ticketTypes->sortBy('price');
        }

        return view('frontend.event',compact('concerts'));
    }

    public function viewConcert($id){

        $concerts = Concert::find($id);

        return view('frontend.viewConcert',compact('concerts'));
    }

    public function bookingConcert($id) {

        $concert = Concert::find($id);

        $seatPrices = Ticket_type::where('concert_id', $id)->pluck('price', 'name');

        return view('frontend.booking', compact('concert', 'seatPrices'));
    }

    public function AddToCart(Request $request){

        $cart = new Cart();
        $cart->user_id = $request->user_id;
        $cart->user_name = $request->user_name;
        $cart->concert_id = $request->concert_id;
        $cart->concert_name = $request->concert_name;
        $cart->seat_number = $request->seat_number;
        $cart->seat_quantity = $request->seat_quantity;
        $cart->total_price = $request->total_price;
        $cart->save();

        Toastr::success('A new ticket has been added to cart, add more?', 'Add Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
        return redirect()->route('home');
    }

    public function booking(){

        return view('frontend.booking');
    }

    // Add similar methods for other views as needed
}
