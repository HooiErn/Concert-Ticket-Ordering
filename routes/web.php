<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/contact', 'App\Http\Controllers\FrontendController@contact')->name('contact');

// Route::get('/event', 'FrontendController@event');

Auth::routes();

//Admin
Route::get('admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

//Ticket Category
Route::post('admin/addCategory',[AdminController::class,'addCategory'])->name('category.add');

Route::get('/admin_dashboard', function () {
    return view('backend/content/admin_dashboard');
});

Route::get('/add_event', function () {
    return view('backend/content/event/add_event');
});
