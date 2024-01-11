<?php

namespace App\Http\Controllers;

use App\Models\order_item;
use DB;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Ticket_type;
use App\Models\Order;
use App\Models\Concert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function dashboard()
    {
        // Assuming you have access to the authenticated user
        $user = auth()->user();

        if ($user && $user->isAdmin()) {

            $currentYear = Carbon::now()->format('Y');
            $currentMonth = Carbon::now()->format('m');

            // Sum up total_amount daily
            $dailyTotal = DB::table('orders')
                ->whereDate('created_at', Carbon::today())
                ->sum('total_amount');

            // Sum up total_amount monthly (current month)
            $monthlyTotal = DB::table('orders')
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->sum('total_amount');

            // Sum up total_amount annually (get current year)
            $annualTotal = DB::table('orders')
                ->whereYear('created_at', $currentYear)
                ->sum('total_amount');

            $totalSeats = Ticket::whereDate('created_at', Carbon::today())
                ->pluck('seat_numbers')
                ->map(function ($seats) {
                    return explode(',', $seats);
                })
                ->flatten()
                ->count();
            
                //show the earning by month
            //     $data = DB::table('orders')
            //     ->select(DB::raw('SUM(total_amount) as total_amount'), DB::raw('MONTH(created_at) as month'))
            //     ->whereYear('created_at', $currentYear)
            //     ->groupBy(DB::raw('MONTH(created_at)'))
            //     ->get();
            // $totalAmounts = [];
            // $months = [];
            // foreach ($data as $row) {
            //     $totalAmounts[] = $row->total_amount;
            //     $months[] = date('F', mktime(0, 0, 0, $row->month, 1));
            // }


            $startDate = now()->startOfWeek();
            $endDate = now()->startOfWeek()->addDays(6);

            $dates = [];
            $totalAmounts = [];

            for ($date = $startDate; $date <= $endDate; $date->addDay()) {
                $orders = DB::table('orders')
                    ->whereDate('created_at', $date)
                    ->get();

                $totalAmount = 0;

                foreach ($orders as $order) {
                    $totalAmount += $order->total_amount;
                }

                // $dates[] = $date->format('l');
                $dates[] = [
                    'day' => $date->format('l'),
                    'date' => $date->format('d F Y'),
                ];
                $totalAmounts[] = $totalAmount;
            }

            $areaChartData = [
                // 'labels' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                'labels' => array_column($dates, 'day'),
                'datasets' => [
                    [
                        'label' => "Earnings",
                        'lineTension' => 0.3,
                        'backgroundColor' => "rgba(78, 115, 223, 0.05)",
                        'borderColor' => "rgba(78, 115, 223, 1)",
                        'pointRadius' => 3,
                        'pointBackgroundColor' => "rgba(78, 115, 223, 1)",
                        'pointBorderColor' => "rgba(78, 115, 223, 1)",
                        'pointHoverRadius' => 3,
                        'pointHoverBackgroundColor' => array_column($dates, 'date'),
                        'pointHoverBorderColor' => "rgba(78, 115, 223, 1)",
                        'pointHitRadius' => 10,
                        'pointBorderWidth' => 2,
                        'data' => $totalAmounts,
                    ]
                ],
            ];
            $startWeek = now()->startOfWeek()->format('d M Y');
            $endWeek = now()->startOfWeek()->addDays(6)->format('d M Y');

            $topThreeConcerts = DB::table('order_items')
                ->select('concert_name', DB::raw('SUM(seat_quantity) as total_seats_sold'))
                ->groupBy('concert_id', 'concert_name')
                ->orderBy('total_seats_sold', 'desc')
                ->limit(3)
                ->get();

            // // Truncate concert names to a certain length
            // $topThreeConcerts = $topThreeConcerts->map(function ($concert) {
            //     $concert->concert_name = Str::limit($concert->concert_name, 20); // Adjust the length as needed
            //     return $concert;
            // });

            return view('backend/content/admin_dashboard', compact('annualTotal', 'dailyTotal', 'monthlyTotal', 'areaChartData', 'totalSeats', 'topThreeConcerts','startWeek','endWeek'));

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
            ['name' => 'VIP', 'price' => $ticketTypes->where('name', 'VIP')->first()->price, 'total' => $ticketTypes->where('name', 'VIP')->first()->total, 'available' => $ticketTypes->where('name', 'VIP')->first()->available],
            ['name' => 'CAT1', 'price' => $ticketTypes->where('name', 'CAT1')->first()->price, 'total' => $ticketTypes->where('name', 'CAT1')->first()->total, 'available' => $ticketTypes->where('name', 'CAT1')->first()->available],
            ['name' => 'CAT2', 'price' => $ticketTypes->where('name', 'CAT2')->first()->price, 'total' => $ticketTypes->where('name', 'CAT2')->first()->total, 'available' => $ticketTypes->where('name', 'CAT2')->first()->available],
            ['name' => 'CAT3', 'price' => $ticketTypes->where('name', 'CAT3')->first()->price, 'total' => $ticketTypes->where('name', 'CAT3')->first()->total, 'available' => $ticketTypes->where('name', 'CAT3')->first()->available],
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

        $ticketTypes = [
            ['concert_id' => $concert->id, 'name' => 'VIP', 'price' => $r->input('price-VIP')],
            ['concert_id' => $concert->id, 'name' => 'CAT1', 'price' => $r->input('price-CAT1')],
            ['concert_id' => $concert->id, 'name' => 'CAT2', 'price' => $r->input('price-CAT2')],
            ['concert_id' => $concert->id, 'name' => 'CAT3', 'price' => $r->input('price-CAT3')],
        ];

        $types = Ticket_type::where('concert_id', $concert->id)->get();
        foreach($types as $type){
            foreach($ticketTypes as $ticketType){
                if($type->name == $ticketType['name']){
                    $type->price=$ticketType['price'];
                    $type->save();
                }
            }
        }
        // foreach ($ticketTypes as $type) {
        //     $ticketType = Ticket_type::where('id', $concert->id)
        //         ->where('name', $type['name'])
        //         ->first();

        //     if ($ticketType) {
        //         $ticketType->price = $type['price'];
        //         $ticketType->save();
        //     }
        // }
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

    public function getTicketTypeInformation($id)
    {

        $concertTickets = order_item::where('concert_id', $id)->get();

        $seatCount = [
            'VIP' => 0,
            'CAT1' => 0,
            'CAT2' => 0,
            'CAT3' => 0,
        ];

        foreach ($concertTickets as $ticket) {
            $seatNumbers = explode(',', $ticket->seat_number);
            foreach ($seatNumbers as $seatNumber) {
                $seatNumber = trim($seatNumber);

                if (!empty($seatNumber)) {
                    $startingLetter = strtoupper($seatNumber[0]);

                    if (in_array($startingLetter, ['A', 'B'])) {
                        $seatCount['VIP']++;
                    } elseif (in_array($startingLetter, ['C', 'D'])) {
                        $seatCount['CAT1']++;
                    } elseif (in_array($startingLetter, ['E', 'F'])) {
                        $seatCount['CAT2']++;
                    } elseif (in_array($startingLetter, ['G', 'H'])) {
                        $seatCount['CAT3']++;
                    }
                }
            }
        }

        $data = [
            'VIP' => $seatCount['VIP'],
            'CAT1' => $seatCount['CAT1'],
            'CAT2' => $seatCount['CAT2'],
            'CAT3' => $seatCount['CAT3'],
        ];

        //Ticket type table information (name,price,total,available)

        $ticketTypes = Ticket_type::all()->where('concert_id', $id);

        $ticketType = [
            ['name' => 'VIP', 'price' => $ticketTypes->where('name', 'VIP')->first()->price, 'total' => $ticketTypes->where('name', 'VIP')->first()->total, 'available' => $ticketTypes->where('name', 'VIP')->first()->total - $data['VIP']],
            ['name' => 'CAT1', 'price' => $ticketTypes->where('name', 'CAT1')->first()->price, 'total' => $ticketTypes->where('name', 'CAT1')->first()->total, 'available' => $ticketTypes->where('name', 'CAT1')->first()->total - $data['CAT1']],
            ['name' => 'CAT2', 'price' => $ticketTypes->where('name', 'CAT2')->first()->price, 'total' => $ticketTypes->where('name', 'CAT2')->first()->total, 'available' => $ticketTypes->where('name', 'CAT2')->first()->total - $data['CAT2']],
            ['name' => 'CAT3', 'price' => $ticketTypes->where('name', 'CAT3')->first()->price, 'total' => $ticketTypes->where('name', 'CAT3')->first()->total, 'available' => $ticketTypes->where('name', 'CAT3')->first()->total - $data['CAT3']],
        ];

        $currentTicketType = Ticket_type::where('concert_id', $id)->get();
        foreach ($currentTicketType as $ticket) {
            foreach ($ticketType as $index => $newTicket) {
                if ($ticket->name == $newTicket['name'] && $ticket->available != $newTicket['available']) {
                    $ticket->available = $newTicket['available'];
                    $ticket->save();
                }
            }
        }

        return $data;
    }

    public function concertDetails($id)
    {
        // // Print the ticket counts for each concert
        // // echo "Concert ID: " . $concert->id . PHP_EOL;
        // echo "VIP Tickets: " . $data['VIP'] . PHP_EOL;
        // echo "CAT1 Tickets: " . $data['CAT1'] . PHP_EOL;
        // echo "CAT2 Tickets: " . $data['CAT2'] . PHP_EOL;
        // echo "CAT3 Tickets: " . $data['CAT3'] . PHP_EOL;
        // echo "---------------------" . PHP_EOL;

        // dd($data);
        $concerts = Concert::find($id);

        $data = $this->getTicketTypeInformation($id);

        $ticketTypeChart = [
            'labels' => ['VIP', 'CAT1', 'CAT2', 'CAT3'],
            'datasets' => [
                [
                    'data' => [$data['VIP'], $data['CAT1'], $data['CAT2'], $data['CAT3']],
                    'backgroundColor' => ['#4e73df', '#1cc88a', '#36b9cc', '#ffcc00'],
                    'hoverBackgroundColor' => ['#2e59d9', '#17a673', '#2c9faf', '#f6c23e'],
                    'hoverBorderColor' => "rgba(234, 236, 244, 1)",
                ]
            ],
        ];

        $ticketTypes = Ticket_type::all()->where('concert_id', $id);

        $totalRevenue = DB::table('order_items')
            ->where('concert_id', '=', $id)
            ->sum('total_price');

        $totalOrdered = DB::table('order_items')
            ->where('concert_id', '=', $id)
            ->sum('seat_quantity');

        $totalSeat = DB::table('ticket_types')
            ->where('concert_id', '=', $id)
            ->sum('total');

        $totalTicketLeft = $totalSeat - $totalOrdered;

        return view('backend/content/event/event_details', compact('concerts', 'ticketTypes', 'totalRevenue', 'totalOrdered', 'totalTicketLeft', 'ticketTypeChart'));

    }

    // public function concertDetails($id)
    // {
    //     $concerts = Concert::find($id);

    //     // $data = DB::table('ticket_types')->where('concert_id', $id)
    //     //     ->select('name', 'available')
    //     //     ->get();

    //     // $labels = $data->pluck('name')->toArray();
    //     // $totalValues = $data->pluck('total')->toArray();
    //     // $availableValues = $data->pluck('available')->toArray();

    //     // $values = [];

    //     // for ($i = 0; $i < count($totalValues); $i++) {
    //     //     //   $difference = $totalValues[$i] - $availableValues[$i];
    //     //     $difference = 30 - $availableValues[$i];
    //     //     $values[] = $difference;
    //     // }



    //     $concertTickets = order_item::where('concert_id', $id)->get();

    //     $seatCount = [
    //         'VIP' => 0,
    //         'CAT1' => 0,
    //         'CAT2' => 0,
    //         'CAT3' => 0,
    //     ];

    //     foreach ($concertTickets as $ticket) {
    //         $seatNumbers = explode(',', $ticket->seat_number);
    //         foreach ($seatNumbers as $seatNumber) {
    //             $seatNumber = trim($seatNumber);

    //             if (!empty($seatNumber)) {
    //                 $startingLetter = strtoupper($seatNumber[0]);

    //                 if (in_array($startingLetter, ['A', 'B'])) {
    //                     $seatCount['VIP']++;
    //                 } elseif (in_array($startingLetter, ['C', 'D'])) {
    //                     $seatCount['CAT1']++;
    //                 } elseif (in_array($startingLetter, ['E', 'F'])) {
    //                     $seatCount['CAT2']++;
    //                 } elseif (in_array($startingLetter, ['G', 'H'])) {
    //                     $seatCount['CAT3']++;
    //                 }
    //             }
    //         }
    //     }

    //     $data = [
    //         'VIP' => $seatCount['VIP'],
    //         'CAT1' => $seatCount['CAT1'],
    //         'CAT2' => $seatCount['CAT2'],
    //         'CAT3' => $seatCount['CAT3'],
    //     ];

    //     // // Print the ticket counts for each concert
    //     // // echo "Concert ID: " . $concert->id . PHP_EOL;
    //     // echo "VIP Tickets: " . $data['VIP'] . PHP_EOL;
    //     // echo "CAT1 Tickets: " . $data['CAT1'] . PHP_EOL;
    //     // echo "CAT2 Tickets: " . $data['CAT2'] . PHP_EOL;
    //     // echo "CAT3 Tickets: " . $data['CAT3'] . PHP_EOL;
    //     // echo "---------------------" . PHP_EOL;

    //     // dd($data);
    //     $ticketTypeChart = [
    //         'labels' => ['VIP', 'CAT1', 'CAT2', 'CAT3'],
    //         'datasets' => [
    //             [
    //                 'data' => [$data['VIP'], $data['CAT1'], $data['CAT2'], $data['CAT3']],
    //                 'backgroundColor' => ['#4e73df', '#1cc88a', '#36b9cc', '#ffcc00'],
    //                 'hoverBackgroundColor' => ['#2e59d9', '#17a673', '#2c9faf', '#f6c23e'],
    //                 'hoverBorderColor' => "rgba(234, 236, 244, 1)",
    //             ]
    //         ],
    //     ];

    //     //Ticket type table information (name,price,total,available)

    //     $ticketTypes = Ticket_type::all()->where('concert_id', $id);

    //     $ticketType = [
    //         ['name' => 'VIP', 'price' => $ticketTypes->where('name', 'VIP')->first()->price, 'total' => $ticketTypes->where('name', 'VIP')->first()->total, 'available' => $ticketTypes->where('name', 'VIP')->first()->total - $data['VIP']],
    //         ['name' => 'CAT1', 'price' => $ticketTypes->where('name', 'CAT1')->first()->price, 'total' => $ticketTypes->where('name', 'CAT1')->first()->total, 'available' => $ticketTypes->where('name', 'CAT1')->first()->total - $data['CAT1']],
    //         ['name' => 'CAT2', 'price' => $ticketTypes->where('name', 'CAT2')->first()->price, 'total' => $ticketTypes->where('name', 'CAT2')->first()->total, 'available' => $ticketTypes->where('name', 'CAT2')->first()->total - $data['CAT2']],
    //         ['name' => 'CAT3', 'price' => $ticketTypes->where('name', 'CAT3')->first()->price, 'total' => $ticketTypes->where('name', 'CAT3')->first()->total, 'available' => $ticketTypes->where('name', 'CAT3')->first()->total - $data['CAT3']],
    //     ];

    //     $currentTicketType = Ticket_type::where('concert_id', $id)->get();
    //     foreach($currentTicketType as $ticket){
    //         foreach($ticketType as $index => $newTicket){
    //             if ($ticket->name == $newTicket['name'] && $ticket->available != $newTicket['available']) {
    //                 $ticket->available = $newTicket['available'];
    //                 $ticket->save();
    //             }
    //         }
    //     }

    //     $totalRevenue = DB::table('order_items')
    //         ->where('concert_id', '=', $id)
    //         ->sum('total_price');

    //     $totalOrdered = DB::table('order_items')
    //         ->where('concert_id', '=', $id)
    //         ->sum('seat_quantity');

    //     $totalSeat = DB::table('ticket_types')
    //         ->where('concert_id', '=', $id)
    //         ->sum('total');

    //     $totalTicketLeft = $totalSeat - $totalOrdered;

    //     return view('backend/content/event/event_details', compact('concerts', 'ticketTypes', 'totalRevenue', 'totalOrdered', 'totalTicketLeft', 'ticketTypeChart'));

    // }

    public function showTicketHistory()
    {
        $tickets = Ticket::all();

        return view('backend/content/ticket/ticket_history', compact('tickets'));
    }

    public function showTicketDetails($id)
    {
        $tickets = Ticket::find($id);
        return view('backend/content/ticket/ticket_details', compact('tickets'));
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

    public function showMembers()
    {
        $users = User::all();
        return view('backend/content/member-list')->with('users', $users);
    }

    public function showOrderList()
    {

        $orderList = Order::with('items') // Eager load the 'items' relationship
            ->select('orders.*', 'orders.created_at as dateTime')
            ->get();

        return view('backend/content/order/order_list', compact('orderList'));
    }

    public function deleteUser($id)
    {
        $users = User::Find($id);
        $users->delete();

        Toastr::success('User deleted successfully', 'Deleted Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" => true, "positionClass" => "toast-top-right"]);
        return redirect()->back();
    }


}
