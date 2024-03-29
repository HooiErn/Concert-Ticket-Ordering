<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
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
        // Validate the input using Validator facade
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            Toastr::error('Invalid email or password', 'Error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Remember me functionality with cookies
            if ($request->has('rememberme')) {
                Cookie::queue('email', $request->email, 1440); // 1440 means it stays for 24 hours
                Cookie::queue('password', $request->password, 1440);
            } else {
                Cookie::queue(Cookie::forget('email'));
                Cookie::queue(Cookie::forget('password'));
            }

            // Check user role and redirect accordingly
            if ($user->isAdmin()) {
                Toastr::success('Welcome back ' . $user->name, 'Login Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
                return redirect('/admin/dashboard');
            } elseif ($user->isMember()) {
                Toastr::success('Welcome back ' . $user->name, 'Login Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
                return redirect('/');
            }

            // Default redirect if user role is neither admin nor member
            return redirect()->back();
        }

        // Authentication failed
        Toastr::error('Invalid email or password', 'Error');
        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
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


    public function registerMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'm_name' => 'required',
            'm_email' => 'required|email|unique:users,email',
            'm_password' => 'required|min:8|max:12',
            'm_confirm_password' => 'required|same:m_password',
            // 'm_contact_number' => 'required|regex:/^[0-9 \-]{10,}$/',

        ]);

        if ($validator->fails()) {
            Toastr::error('Invalid input, please try again.', 'Validation Error', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $addMember = User::create([
            'name' => $request->m_name,
            'email' => $request->m_email,
            'role' => 2,
            'password' => Hash::make($request->m_password),
            'contact_number' => $request->m_contact_number,
        ]);

        if ($addMember) {
            Toastr::success('Account has been successfully registered', 'Register Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
            return redirect('/login/form');
        } else {
            Toastr::error('Registration failed. Please try again', 'Error', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
            return redirect('/login/form')->withInput();
        }

    }


}
