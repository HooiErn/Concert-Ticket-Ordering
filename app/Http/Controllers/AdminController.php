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

            return redirect()->route('login.form');
        }
    }

    public function addConcert()
    {
        $r = request();
        // Validate the form inputs

        // Process the uploaded images
        $concertImages = [];
        $count = 0;
        if ($r->hasFile('concert_images')) {
            foreach ($r->file('concert_images') as $image) {
                //$filename = $image->store('images', 'public');
                $image->move('images', $image->getClientOriginalName());
                $filename = $image->getClientOriginalName();
                $concertImages[] = $filename;
                $count++;
            }

            for ($i = $count + 1; $i <= 5; $i++) {
                $filename = "empty.jpg";
                $concertImages[] = $filename;
            }
        } else {
            for ($i = 0; $i < 5; $i++) {
                $filename = "empty.jpg";
                $concertImages[] = $filename;
            }
        }

        // Save the concert details and image filenames
        $concert = new Concert();
        $concert->name = $r->input('concert-name');
        $concert->date_time = $r->input('concert-datetime');
        $concert->venue = $r->input('concert-venue');
        $concert->description = $r->input('concert-description');
        $concert->organizer_name = $r->input('concert-organizer');
        $concert->images = json_encode($concertImages);
        $concert->save();

        $ticketType = [
            ['concert_id' => $concert->id, 'name' => 'VIP', 'price' => $r->input('price-VIP'), 'total' => 20, 'available' => 20],
            ['concert_id' => $concert->id, 'name' => 'CAT1', 'price' => $r->input('price-CAT1'), 'total' => 20, 'available' => 20],
            ['concert_id' => $concert->id, 'name' => 'CAT2', 'price' => $r->input('price-CAT2'), 'total' => 20, 'available' => 20],
            ['concert_id' => $concert->id, 'name' => 'CAT3', 'price' => $r->input('price-CAT3'), 'total' => 20, 'available' => 20],
        ];

        Ticket_type::insert($ticketType);

        // Redirect or return a response
        return redirect()->route('showConcert');

    }

    public function editConcert($id)
    {

        $concerts = Concert::findOrFail($id);
        $ticketTypes = Ticket_type::all()->where('concert_id', $id);

        // Decode the JSON data to get the array of image filenames
        $concertImages = json_decode($concerts->images);


        $ticketType = [
            ['name' => 'VIP', 'price' => $ticketTypes->where('name', 'VIP')->first()->price, 'total' => 0, 'available' => 0],
            ['name' => 'CAT1', 'price' => $ticketTypes->where('name', 'CAT1')->first()->price, 'total' => 0, 'available' => 0],
            ['name' => 'CAT2', 'price' => $ticketTypes->where('name', 'CAT2')->first()->price, 'total' => 0, 'available' => 0],
            ['name' => 'CAT3', 'price' => $ticketTypes->where('name', 'CAT3')->first()->price, 'total' => 0, 'available' => 0],
        ];

        // Pass the variables to the view
        return view('backend/content/event/edit_event', compact('concerts', 'concertImages', 'ticketType'));
    }

    public function updateConcert()
    {
        $r = request();
        // Validate the form inputs
        $concert = Concert::find($r->input('concert-id'));

        $existingImages = json_decode($concert->images);
        // Process the uploaded images
        $concertImages = [];
        $concertImages = $existingImages;
        if ($r->hasFile('concert_images')) {
            foreach ($r->file('concert_images') as $index => $image) {
                if ($r->hasFile('concert_images.' . $index)) {
                    $image->move('images', $image->getClientOriginalName());
                    $filename = $image->getClientOriginalName();
                    $concertImages[$index] = $filename;
                }
            }
        }
       

        // Save the concert details and image filenames
        $concert->name = $r->input('concert-name');
        $concert->date_time = $r->input('concert-datetime');
        $concert->venue = $r->input('concert-venue');
        $concert->description = $r->input('concert-description');
        $concert->organizer_name = $r->input('concert-organizer');
        $concert->images = json_encode($concertImages);
        $concert->save();

        $ticketType = [
            ['concert_id' => $concert->id, 'name' => 'VIP', 'price' => $r->input('price-VIP')],
            ['concert_id' => $concert->id, 'name' => 'CAT1', 'price' => $r->input('price-CAT1')],
            ['concert_id' => $concert->id, 'name' => 'CAT2', 'price' => $r->input('price-CAT2')],
            ['concert_id' => $concert->id, 'name' => 'CAT3', 'price' => $r->input('price-CAT3')],
        ];

        foreach ($ticketType as $type) {
            $ticketType = Ticket_type::where('id', $concert->id)
                ->where('name', $type['name'])
                ->first();

            if ($ticketType) {
                $ticketType->price = $type['price'];
                $ticketType->save();
            }
        }
        // Redirect or return a response
        return redirect()->route('showConcert');


    }

    public function showConcert()
    {
        $concerts = Concert::all();

        $concertImages = [];

        foreach ($concerts as $concert) {
            $images = json_decode($concert->images, true);
            if (!empty($images)) {
                $concertImages[] = $images[0];
            } else {
                $concertImages[] = null;
            }
        }
        return view('backend/content/event/show_event', compact('concerts', 'concertImages'))->render();
    }

    public function deleteConcert($id)
    {
        $concert = Concert::Find($id);
        $concert->delete();
        return redirect()->route('showConcert');
    }

    public function concertDetails($id)
    {
        $concerts = Concert::all()->where('id', $id);
        return view('backend/content/event/event_details')->with('concerts', $concerts);
    }


    // public function addConcert(Request $request){

    //     $validator = Validator::make($request->all(), [
    //         'c_name' => 'unique:ticket_types,name',
    //     ]);

    //     if ($validator->fails()) {
    //         Toastr::error('This category name already exists. Please try again.', 'Error', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $categories = Ticket_type::create([
    //         'name' => $request -> c_name,
    //     ]);

    //     Toastr::success('A new ticket category has been added', 'Add Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
    //     return redirect('admin/category/AddTicketType');
    // }


    public function indexCategory()
    {
        return view('backend/content/category/AddTicketType');
    }

    //Add Category
    public function addCategory(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'c_name' => 'unique:ticket_types,name',
        ]);

        if ($validator->fails()) {
            Toastr::error('This category name already exists. Please try again.', 'Error', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $categories = Ticket_type::create([
            'name' => $request->c_name,
        ]);

        Toastr::success('A new ticket category has been added', 'Add Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
        return redirect('admin/category/AddTicketType');
    }

    //Update Category
    public function UpdateCategory(Request $request)
    {
        if (Ticket_type::where('name', $request->name)->exists()) {
            Toastr::error('This category name already exists. Please try again.', 'Repeat name', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
            return redirect()->back()->withInput()->withErrors(['edit_c_name' => 'Duplicate name has been used.']);
        }

        $categories = Ticket_type::where('id', $request->catID)->first();

        $categories->name = $request->name;
        $categories->save();

        Toastr::success('A new ticket category has been updated', 'Updated Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
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
