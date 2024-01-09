<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TicketPriceController;
use App\Http\Controllers\TicketController;

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

// Route::get('/viewconcert', function () {
//     return view('frontend/viewconcert');
// });

//---------------------------------------------------------------Auth Area-------------------------------------------------//
// Login & Logout
Route::get('/login/form', [HomeController::class, 'login_form'])->name('login.form');
Route::post('/checkLogin', [HomeController::class, 'check_login'])->name('check.login');
Route::get('/logout', [HomeController::class, 'logout']);
Route::post('/user-register', [HomeController::class, 'registerMember'])->name('user.register');

//---------------------------------------------------------------Frontend Area-------------------------------------------------//

// Home Page
Route::get('/', [FrontendController::class, 'home'])->name('home');

// user profile page
Route::get('/user-dashboard', [FrontendController::class, 'showUserDashboard'])->name('show.userDashboard');

// Concert Page and Function
Route::get('/concert', [FrontendController::class, 'concert'])->name('concert');

// View Concert
Route::get('/viewConcert/{id}', [FrontendController::class, 'viewConcert'])->name('viewConcert');

// Booking and Function With Concert Id
Route::get('/bookingConcert/{id}', [FrontendController::class, 'bookingConcert'])->name('bookingConcert');

// Add To Cart
Route::post('/AddToCart', [FrontendController::class, 'AddToCart'])->name('AddToCart');

// Show My Cart
Route::get('/MyCart', [FrontendController::class, 'MyCart'])->name('MyCart');

//Payment
Route::post('/checkout', [App\Http\Controllers\PaymentController::class, 'paymentPost'])->name('payment.post');

// Payment Function
Route::post('stripe/checkout', [FrontendController::class, 'stripeCheckout'])->name('stripe.checkout');

// Payment Success
Route::get('stripe/checkout/success',[FrontendController::class,'stripeCheckoutSuccess'])->name('stripe.checkout.success');

// Show All User Order
Route::get('/allorder', [FrontendController::class, 'allorder'])->name('allorder');

// Show All User Order Detail
Route::get('/vieworder/{id}', [FrontendController::class, 'vieworder'])->name('vieworder');

// Booking and Function
Route::get('/booking', [FrontendController::class, 'booking'])->name('booking');

// Contact Page and Function
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

Route::get('/api/ticket-prices/{concertId}', [TicketPriceController::class, 'getTicketPrices']);

//generate pdf
Route::get('/download-ticket-pdf/{ticketId}', [TicketController::class, 'downloadTicketPdf'])->name('download.ticket.pdf');


Auth::routes();

//---------------------------------------------------------------Admin Area-------------------------------------------------//
Route::middleware(['auth', 'auth.admin'])->group(function () {

    //Ticket Category
    Route::get('/add', [AdminController::class, 'indexCategory']);
    // Route::post('admin/addTicketType/post',[AdminController::class,'addCategory'])->name('category.add');

    //Event Details
    Route::get('admin/concert_details', function () {
        return view('backend/content/event/event_details');
    });

});

// Route::get('admin/order_list', [AdminController::class, 'showOrderList']);

Route::get('admin/order_list', [AdminController::class, 'showOrderList'])->name('showOrder');

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

Route::get('/delete_concert/{id}', [App\Http\Controllers\AdminController::class, 'deleteConcert'])->name('deleteConcert');

Route::get('/concert_details/{id}', [App\Http\Controllers\AdminController::class, 'concertDetails'])->name('concertDetails');

Route::get('/showMembers', [App\Http\Controllers\AdminController::class, 'showMembers'])->name('showMembers');

// Admin Dasboard
Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
