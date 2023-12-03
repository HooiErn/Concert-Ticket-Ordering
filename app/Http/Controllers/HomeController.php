<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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

    
    public function registerMember(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'm_name' => 'required',
            'm_email' => 'required|email|unique:users,email',
            'm_password' => 'required|min:8|max:12',
            'm_confirm_password' => 'required|same:m_password',
            'm_contact_number' => 'required|numeric|regex:/^[0-9]{10,}$/',
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
            Toastr::success('Account has been successfully registered', 'Register Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-full-width"]);
            return redirect('/login/form');
        } else {
            Toastr::error('Registration failed. Please try again', 'Error', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-full-width"]);
            return redirect('/login/form')->withInput();
        }
        
    }
    
 
    // Show Forgot Password Form
    public function showForgotPasswordForm()
    {
        return view('auth.passwords.email');
    }

    // Send Reset Password Email
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            Toastr::error('Invalid email format.', 'Validation Error', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // Show Reset Password Form
    public function showResetPasswordForm($token)
    {
        return view('auth.passwords.reset')->with(['token' => $token, 'email' => request('email')]);
    }

    // Reset Password
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60), // Use Str::random(60) to generate a random token
                ])->save();

                $this->guard()->login($user);
            }
        );

        return $response === Password::PASSWORD_RESET
            ? redirect($this->redirectPath())
            : back()->withErrors(['email' => [__($response)]]);
    }

}
