<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('frontend/main');
});

// Login & Logout
Route::get('/login/form', [HomeController::class, 'login_form'])->name('login.form');
Route::post('/checkLogin', [HomeController::class, 'check_login'])->name('check.login');
Route::get('/logout', [HomeController::class, 'logout']);
Route::post('/user-register', [HomeController::class, 'registerMember'])->name('user.register');

// Forgot Password and Reset Password Routes
Route::get('/forgot-password', [HomeController::class, 'showForgotPasswordForm'])->name('password.show');
Route::post('/forgot-password', [HomeController::class, 'sendResetLinkEmail'])->name('reset.email');
Route::get('/reset-password/{token}', [HomeController::class, 'showResetPasswordForm'])->name('password.reset.show');
Route::post('/reset-password', [HomeController::class, 'resetPassword'])->name('password.reset.submit');

Route::get('/contact', 'App\Http\Controllers\FrontendController@contact')->name('contact');

// Route::get('/event', 'FrontendController@event');

Auth::routes();

//Admin
Route::get('admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

//Ticket Category
Route::get('/add',[AdminController::class,'indexCategory']);
// Route::post('admin/addTicketType/post',[AdminController::class,'addCategory'])->name('category.add');

Route::get('/admin_dashboard', function () {
    return view('backend/content/admin_dashboard');
});

Route::get('admin/add_event', function () {
    return view('backend/content/event/add_event');
});

Route::get('admin/add_date', function () {
    return view('backend/content/event/add_date');
});

Route::get('/add_ticket_type', function () {
    return view('backend/content/event/add_ticket_type');
});
// Route::get('/add_ticket_type', function () {
//     return view('backend/content/category/AddTicketType');
// });
