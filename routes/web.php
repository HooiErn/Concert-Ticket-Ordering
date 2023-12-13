<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;

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

//---------------------------------------------------------------Auth Area-------------------------------------------------//
// Login & Logout
Route::get('/login/form', [HomeController::class, 'login_form'])->name('login.form');
Route::post('/checkLogin', [HomeController::class, 'check_login'])->name('check.login');
Route::get('/logout', [HomeController::class, 'logout']);
Route::post('/user-register', [HomeController::class, 'registerMember'])->name('user.register');

//---------------------------------------------------------------Frontend Area-------------------------------------------------//

// Event Page and Function
Route::get('/event', [FrontendController::class, 'event'])->name('event');

// Contact Page and Function
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

// Booking and Function
Route::get('/booking', [FrontendController::class, 'booking'])->name('booking');

// Route::get('/event', 'FrontendController@event');

Auth::routes();

//---------------------------------------------------------------Admin Area-------------------------------------------------//
Route::middleware(['auth', 'auth.admin'])->group(function () {

    // Admin Dasboard
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    //Ticket Category
    Route::get('/add', [AdminController::class, 'indexCategory']);
    // Route::post('admin/addTicketType/post',[AdminController::class,'addCategory'])->name('category.add');



    //Event Details
    Route::get('admin/concert_details', function () {
        return view('backend/content/event/event_details');
    });

    // //Show Event
    // Route::get('admin/show_concert', function () {
    //     return view('backend/content/event/show_event');
    // });


});

//Admin
// Route::get('admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin');

// Route::get('/add_ticket_type', function () {
//     return view('backend/content/event/add_ticket_type');
// });

Route::get('admin/order_list', function () {
    return view('backend/content/order/order_list');
});

Route::get('ticket_details', function () {
    return view('backend/content/ticket/ticket_details');
});

Route::get('ticket_history', function () {
    return view('backend/content/ticket/ticket_history');
});

Route::get('profile', function () {
    return view('backend/content/user/profile');
});

Route::get('edit_profile', function () {
    return view('backend/content/user/edit_profile');
});

//Add Event
Route::get('admin/add_concert', function () {
    return view('backend/content/event/add_event');
});

Route::post('/add_concert/new', [App\Http\Controllers\AdminController::class, 'addConcert'])->name('addConcert');

Route::get('/edit_concert/{id}', [App\Http\Controllers\AdminController::class, 'editConcert'])->name('editConcert');

Route::post('/update_concert', [App\Http\Controllers\AdminController::class, 'updateConcert'])->name('updateConcert');

Route::get('/show_concert', [App\Http\Controllers\AdminController::class, 'showConcert'])->name('showConcert');

