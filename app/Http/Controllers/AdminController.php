<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin/dashboard');
    }

     //Add Category
     public function addCategory(Request $request){

        $validator = Validator::make($request->all(), [
            'c_name' => 'unique:categories,name',
        ]);

        if ($validator->fails()) {
            Toastr::error('This category name already exists. Please try again.', 'Error', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = Category::create([
            'name' => $request -> c_name,
        ]);

        Toastr::success('A new ticket category has been added', 'Add Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
        return redirect('admin/category');
    }
}
