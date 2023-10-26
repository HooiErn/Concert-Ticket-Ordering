<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin/dashbourd');
    }
}
