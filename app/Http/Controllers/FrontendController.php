<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Ticket_type;
use App\Models\Order;
use App\Models\order_item;
use App\Models\Concert;
use App\Models\Seat;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Stripe\Stripe;

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

    public function MyCart(){

        if(Auth::check()){

            // Get the authenticated user's ID
            $userId = Auth::id();

            // Retrieve cart items for the user
            $cartItems = Cart::where('user_id', $userId)->get();

            // Calculate the total order amount
            $totalAmount = $cartItems->sum('total_price');

            return view('frontend.mycart',compact('cartItems','totalAmount'));

        }
    }

    public function stripeCheckout(Request $request)
    {
        // Use the correct Stripe API key
        if (Auth::check()) {

            try{

                // Check if the user's cart is not empty
                $cartItems = Cart::where('user_id', $request->user_id)->get();

                if ($cartItems->isEmpty()) {
                    return back()->with('error', 'Your cart is empty. Add items to your cart before proceeding to checkout.');
                }

                // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

                $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';

                $response = \Stripe\Checkout\Session::create([
                    'success_url' => $redirectUrl,
                    'customer_email' => 'andy@gmail.com',
                    'payment_method_types' => ['link','card'],
                    'line_items' => [
                        [
                            'price_data' => [
                                'product_data' => [
                                    'name' => $request->concert_name,
                                ],
                                'unit_amount' => 100 * $request->total_amount,
                                'currency' => 'USD',
                            ],
                            'quantity' => $request->seat_quantity,
                        ],
                    ],
                    'mode' => 'payment',
                    'allow_promotion_codes' => true,
                ]);

                // Add To Order
                $order = new Order();
                $order->user_id = $request->user_id;
                $order->user_name = $request->user_name;
                $order->user_email = $request->user_email;
                $order->concert_name = $request->concert_name;
                $order->total_amount = $request->total_amount;
                $order->save();

                // Capture the ID of the newly created order
                $order_id = $order->id;

                // Save order details to the orders table for each item in the cart
                $cartItems = Cart::where('user_id', $request->user_id)->get();

                // Add To Order_Item
                foreach ($cartItems as $cartItem) {
                    $orderItems = new Order_item();
                    $orderItems->order_id = $order_id;
                    $orderItems->concert_id = $cartItem->concert_id;
                    $orderItems->concert_name = $cartItem->concert_name;
                    $orderItems->seat_quantity = $cartItem->seat_quantity;
                    $orderItems->seat_number = $cartItem->seat_number;
                    $orderItems->total_price = $request->total_price;

                    $orderItems->save();

                    $cartItem->delete();

                }

                // Mail::send('backend.email.orderemail', ['data' => $data], function($message) use ($data) {
                //     $message->to('ahpin7762@gmail.com')
                //         ->subject($data['subject']);
                // });

                return back()->with('success','You Order Has Successfully!');

            }catch (Exception $e) {

                return back()->with('fail', 'Failed to Contact. Please try again.');
            }

        } else {

            // Redirect if the user is not authenticated
            return redirect('/loginpage')->with('error', 'You need to log in first!');
        }

        // jeremypoh0205@gmail.com
        // dchooiern@gmail.com

        // Clear the user's cart after completing the order
        // Cart::where('user_id', $request->user_id)->delete();

        // return redirect($response['url']);
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $response = $stripe->checkout->sessions->retrieve($request->session_id);

        return redirect()->route('home')->with('success','Payment successful.');
    }

    public function allorder(){

        $orders = Order::paginate(10);

        return view('frontend.myorder',compact('orders'));
    }

    public function vieworder($id)
    {
        // Find the order
        $userorder = Order::find($id);

        // Check if the order exists
        if (!$userorder) {
            abort(404); // or handle the case when the order is not found
        }

        // Retrieve the associated items using the defined relationship
        $orderItems = $userorder->items;

        // Check if items are retrieved
        if ($orderItems->isEmpty()) {
            // Handle the case when no items are found, e.g., return an error message
            return view('frontend.orderdetail', compact('userorder'))->withErrors('No items found for this order.');
        }

        // Calculate the total price
        $totalSum = $orderItems->sum('total_price');

        // Debug: Check if items are retrieved before calculating totalSum
        // dd($orderItems);

        // Pass the $orderItems variable to the view
        return view('frontend.orderdetail', compact('userorder', 'orderItems', 'totalSum'));
    }

    // public function booking(){

    //     return view('frontend.booking');
    // }

    // Add similar methods for other views as needed
}
