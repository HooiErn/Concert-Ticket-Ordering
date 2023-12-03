<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;
use Cookie;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function login_form()
    {
        return view('frontend/login');
    }
    
    // Check Login
    public function check_login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        $user = User::where('email', $request->email)->first();
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($request->has('rememberme')){
                Cookie::queue('email',$request->email,1440); //1440 means it stays for 24 hours
                Cookie::queue('password',$request->password,1440);
            }
            else{
                Cookie::queue(Cookie::forget('email'));
                Cookie::queue(Cookie::forget('password'));
            }
    
            if ($user->isAdmin()) {
                Toastr::success('Welcome back '.$request->email, 'Login Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
                return redirect('admin/dashboard');
            } elseif ($user->isMember()) {
                Toastr::success('Welcome back '.$request->email, 'Login Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
                return redirect('/');
            }    
            return redirect()->back();
        }
    
        Toastr::error('Invalid email or password', 'Error');
        return redirect()->back()->withErrors($validator)->withInput();
    }
    
    // Logout
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        Toastr::info('You have logged out of your account', 'Logout Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
        return redirect('/');
    }

    
    public function registerMember(Request $request){
        $validator = Validator::make($request->all(), [
            'm_name' => [
                Rule::unique('users', 'name')->where(function ($query) {
                    return $query->where('role', 2);
                }),
            ],
            'm_password' => 'max:12',
            'm_confirm_password' => 'same:m_password',
        ]);

        if($validator -> fails()){
            Toastr::error('Invalid input please try again.', 'Validate Fail', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
        $addMember = User::create([
            'name' => $request -> m_name,
            'role' => 2,
            'password' => Hash::make($request -> m_password),
            'contact_number'=> $request -> m_contact_number,
        ]);

        Toastr::success('You successfully register a new member account','Register',["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
        return redirect()->back();
    }

}
