@extends('frontend/layout')
@section('title', 'My Cart')
@section('content')

    <br><br><br><br><br>
     <style> 
        h1, h2, h3, h4, h5, h6 {
            font-weight: bold; /* Make headings bold */
            color: black; /* Set a color for headings */
        }

    </style>

    <section class="h-100" style="background-color: #eee;">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="fw-normal mb-0 text-black">My Cart</h1>
                    </div>

                    <form action="{{ route('stripe.checkout') }}" method="post">
                        @csrf

                        <div class="card rounded-3 mb-4">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <h3 class="mb-0">Concert Name</h3>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <h3 class="mb-0">Seat Quantity</h3>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <h3 class="mb-0">Seat Number</h3>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <h3 class="mb-0">Price</h3>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <h3 class="mb-0">Action</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach ($cartItems as $cartItem)

                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="user_name" value="{{ auth()->user()->name }}">
                        <input type="hidden" name="user_email" value="{{ auth()->user()->email }}">
                        <input type="hidden" name="concert_id" value="{{ $cartItem->concert_id }}">
                        <input type="hidden" name="concert_name" value="{{ $cartItem->concert_name }}">
                        <input type="hidden" name="seat_quantity" value="{{ $cartItem->seat_quantity }}">
                        <input type="hidden" name="seat_number" value="{{ $cartItem->seat_number }}">
                        <input type="hidden" name="total_price" value="{{ $cartItem->total_price }}">
                        <input type="hidden" name="total_amount" value="{{ $totalAmount }}">

                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4 d-flex flex-column">
                                    <!-- Header and Data Row -->
                                    <div class="row mb-2">
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h4 class="mb-0">{{ $cartItem->concert_name }}</h4>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h4 class="mb-0">{{ $cartItem->seat_quantity }}</h4>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h4 class="mb-0">{{ $cartItem->seat_number }}</h4>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <h4 class="mb-0">{{ $cartItem->total_price }}</h4>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="card rounded-3 mb-4">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-10 col-lg-10 col-xl-10 text-end">
                                        <h2 class="mb-0">Total Price: ${{ $totalAmount }} </h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-warning btn-block btn-lg" style="font-weight:bold; font-size:20px">Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
