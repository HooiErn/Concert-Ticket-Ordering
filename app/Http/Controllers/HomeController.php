<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
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
            'name' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('name', 'password');
    
        $user = User::where('name', $request->name)->first();
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($request->has('rememberme')){
                Cookie::queue('name',$request->name,1440); //1440 means it stays for 24 hours
                Cookie::queue('password',$request->password,1440);
            }
            else{
                Cookie::queue(Cookie::forget('name'));
                Cookie::queue(Cookie::forget('password'));
            }
    
            if ($user->isAdmin()) {
                Toastr::success('Welcome back '.$request->name, 'Login Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
                return redirect('admin/dashboard');
            } elseif ($user->isMember()) {
                Toastr::success('Welcome back '.$request->name, 'Login Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
                return redirect('/');
            }    
            return redirect()->back();
        }
    
        Toastr::error('Invalid name or password', 'Error');
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

}
