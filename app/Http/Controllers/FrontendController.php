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

        // Fetch cart count for the authenticated user
        $cartCount = $this->getCartCount();

        return view('frontend.main', compact('concerts', 'cartCount'));
    }

    public function contact()
    {
         $cartCount = $this->getCartCount();
         return view('frontend.contact', compact('cartCount'));
    }

    public function concert()
    {
        $cartCount = $this->getCartCount();
        $concerts = Concert::all();
         // getting concert price
        foreach ($concerts as $concert) {
            $concert->ticketTypes = Ticket_type::where('concert_id', $concert->id)->get();
            $concert->sortedTicketTypes = $concert->ticketTypes->sortBy('price');
        }

        return view('frontend.event',compact('concerts', 'cartCount'));
    }

    public function viewConcert($id){
        $cartCount = $this->getCartCount();
        $concerts = Concert::find($id);

        return view('frontend.viewConcert',compact('concerts', 'cartCount'));
    }

    public function bookingConcert($id, Request $request) {
        // Check if the user is authenticated
        $cartCount = $this->getCartCount();
        if (Auth::check()) {
            // The user is authenticated,
            $user = Auth::user(); // Get the authenticated user

            // Retrieve the concert details by its ID
            $concert = Concert::find($id);

            // Retrieve seat prices for the specific concert
            $seatPrices = Ticket_type::where('concert_id', $id)->pluck('price', 'name');

            // Retrieve all the sold seat numbers for the specific concert
            $seatNumbersString = Ticket::where('concert_id', $id)->pluck('seat_numbers')->toArray();
            $soldSeatNumbers = [];

            // Iterate over each set of seat numbers and merge them into the $soldSeatNumbers array
            foreach ($seatNumbersString as $numbers) {
                $soldSeatNumbers = array_merge($soldSeatNumbers, explode(', ', $numbers));
            }

            // Pass the retrieved data to the frontend.booking view
            return view('frontend.booking', compact('concert', 'seatPrices', 'user', 'cartCount', 'soldSeatNumbers'));
        } else {
            // The user is not authenticated, redirect them to the login page
            return redirect('/login/form')->with('error', 'You need to log in first.');
        }
    }

    public function getCartCount()
    {
        $cartCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $cartCount = Cart::where('user_id', $userId)->count();
        }
        return $cartCount;
    }

    public function AddToCart(Request $request){

        $cart = new Cart();
        $cart->user_id = $request->user_id;
        $cart->user_name = $request->user_name;
        $cart->concert_id = $request->concert_id;
        $cart->concert_name = $request->concert_name;
        // Process and sort seat numbers
        $seatNumbers = explode(', ', $request->seat_number);
        sort($seatNumbers); // Sort seat numbers in ascending order
        $sortedSeatNumbers = implode(', ', $seatNumbers);
        $cart->seat_number = $sortedSeatNumbers;
        $cart->seat_quantity = $request->seat_quantity;
        $cart->total_price = $request->total_price;
        $cart->save();

        Toastr::success('A new ticket has been added to cart, add more?', 'Add Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
        return redirect()->route('MyCart');
    }

    public function MyCart(){

        if(Auth::check()){

            // Get the authenticated user's ID
            $userId = Auth::id();

            // Retrieve cart items for the user
            $cartItems = Cart::where('user_id', $userId)->get();

            // Calculate the total order amount
            $totalAmount = $cartItems->sum('total_price');

            // Fetch cart count for the authenticated user
            $cartCount = 0;
            if (Auth::check()) {
                $userId = Auth::id();
                $cartCount = Cart::where('user_id', $userId)->count();
            }

            return view('frontend.mycart', compact('cartItems', 'totalAmount', 'cartCount'));
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

                   // Add To Ticket
                    $ticket = new Ticket();
                    $ticket->ticket_id = 'TICKET-' . uniqid();
                    $ticket->user_id = $request->user_id;
                    $ticket->concert_id = $cartItem->concert_id;
                    $ticket->seat_quantity = $cartItem->seat_quantity;
                    $ticket->total_price = $cartItem->total_price;
                    $ticket->seat_numbers = $cartItem->seat_number;
                    $ticket->save();

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

      public function showUserDashboard()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Retrieve the user's tickets with eager-loaded user data
        $userTickets = Ticket::where('user_id', $user->id)->with('user')->get();

        // Add logic to retrieve and display the user's profile
        // For example, you can pass $user and $userTickets to the view
        return view('frontend.userdashboard', compact('user', 'userTickets'));
    }

     public function search(Request $request)
        {
            $query = $request->input('query');

            // Perform the search logic
            $concerts = Concert::where('name', 'like', '%' . $query . '%')->get();

            // Return the search results to the view
            return view('frontend.event', compact('concerts', 'query'));
        }
}
