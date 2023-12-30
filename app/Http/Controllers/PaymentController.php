<?php

namespace App\Http\Controllers;

use Stripe;
use Illuminate\Http\Request;
use Notification;

class PaymentController extends Controller
{   
     public function paymentPost(Request $request)
    {
        //Link Api Key
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create ([
                    "amount" => $request->sub*100,   // RM10  10=10 cen 10*100=1000 cen
                    "currency" => "MYR",
                    "source" => $request->stripeToken,
                    "description" => "This payment is testing purpose of southern online",
            ]);

            $email='admin@gmail.com';
            Notification::route('mail',$email)->notify(new
            \App\Notifications\orderPaid($email));
            
            return back();
        }
}