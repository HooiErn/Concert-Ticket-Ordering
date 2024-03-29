@extends('frontend/layout')
@section('title', 'My Cart')
@section('content')

    <br><br><br><br><br>
    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: bold;
            /* Make headings bold */
            color: black;
            /* Set a color for headings */
        }

        h5 {
            font-size: 16px !important;
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
                                        <h5 class="mb-0">Concert Name</h5>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <h5 class="mb-0">Seat Quantity</h5>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <h5 class="mb-0">Seat Number</h5>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <h5 class="mb-0">Price</h5>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <h5 class="mb-0">Action</h5>
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
                                            <h5 class="mb-0">{{ $cartItem->concert_name }}</h4>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h5 class="mb-0">{{ $cartItem->seat_quantity }}</h5>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h5 class="mb-0">{{ $cartItem->seat_number }}</h5>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <h5 class="mb-0">{{ $cartItem->total_price }}</h5>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="{{ route('delete.cartItem', ['cartItemId' => $cartItem->id]) }}"
                                                class="text-danger"
                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                                <i class="fas fa-trash fa-lg"></i>
                                            </a>
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


    <div class="card rounded-3 mb-4">
        <div class="card-body p-4">
            <!-- Existing code for concert details -->

            <!-- Card Information -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cardNumber">Card Number</label>
                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="expirationMonth">Expiration Month</label>
                    <input type="text" class="form-control" id="expirationMonth" name="expirationMonth" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="expirationYear">Expiration Year</label>
                    <input type="text" class="form-control" id="expirationYear" name="expirationYear" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nameOnCard">Name on Card</label>
                    <input type="text" class="form-control" id="nameOnCard" name="nameOnCard" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="cvc">CVC</label>
                    <input type="text" class="form-control" id="cvc" name="cvc" required>
                </div>
            </div>
        </div>
    </div>

                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-warning btn-block btn-lg"
                                    style="font-weight:bold; font-size:20px">Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
