<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Ticket_type;
use App\Models\Order;
use App\Models\Concert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;

class AdminController extends Controller
{

    public function dashboard()
    {
        // Assuming you have access to the authenticated user
        $user = auth()->user();

        if ($user && $user->isAdmin()) {

            return view('backend/content/admin_dashboard');

        } else {

            return redirect()->route('login'); // Change 'login' to the actual route name of your login form
        }
    }


    public function indexCategory(){
        return view('backend/content/category/AddTicketType');
    }

     //Add Category
    public function addCategory(Request $request){

        $validator = Validator::make($request->all(), [
            'c_name' => 'unique:ticket_types,name',
        ]);

        if ($validator->fails()) {
            Toastr::error('This category name already exists. Please try again.', 'Error', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $categories = Ticket_type::create([
            'name' => $request -> c_name,
        ]);

        Toastr::success('A new ticket category has been added', 'Add Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
        return redirect('admin/category/AddTicketType');
    }

     //Update Category
    public function UpdateCategory(Request $request){
        if (Ticket_type::where('name', $request->name)->exists()) {
            Toastr::error('This category name already exists. Please try again.', 'Repeat name', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return redirect()->back()->withInput()->withErrors(['edit_c_name' => 'Duplicate name has been used.']);
        }

        $categories = Ticket_type::where('id',$request -> catID)->first();

        $categories -> name = $request -> name;
        $categories -> save();

        Toastr::success('A new ticket category has been updated', 'Updated Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
        return redirect('backend/content/category');
    }

     //Delete Category
    //  public function DeleteCategory(Request $request){
    //     $categories = Ticket_type::where('id',$id)->first();
    //     $categories -> delete();

    //     Toastr::success('A ticket category has been deleted', 'Deleted Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
    //     return redirect('backend/content/category');
    // }
}
