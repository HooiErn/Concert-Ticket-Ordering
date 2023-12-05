<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.main');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function event()
    {
        return view('frontend.event');
    }

    public function booking(){

        return view('frontend.booking');
    }

    // Add similar methods for other views as needed
}
