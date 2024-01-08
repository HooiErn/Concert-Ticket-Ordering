@extends('frontend/layout')
@section('title', 'Booking Ticket')
@section('content')
    <link rel="stylesheet" href="{{ asset('seat/style.css') }}" />

    <section class="seatPage">
        <form action="{{ url('/AddToCart') }}" method="post" class="bookingForm">
            @csrf
            <input type="hidden" name="concert_id" value="{{ $concert->id }}">
            <input type="hidden" name="concert_name" value="{{ $concert->name }}">
            <input type="hidden" name="seat_quantity" value="">
            <input type="hidden" name="seat_number" value="">
            <input type="hidden" name="total_price" value="">
            <input type="hidden" name="user_name" value="{{ auth()->user()->name }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="movie-container">
                <h5 style="font-weight:bold">CONCERT NAME: <span>{{ $concert->name }}</h5>
                <h5 style="font-weight:bold">DATE: <span>{{ $concert->date_time }}</h5>
            </div>

            <ul class="showcase">
                <li>
                    <div class="seat cannot-select"></div>
                    <small>Available</small>
                </li>
                <li>
                    <div class="seat seat-selected-display cannot-select"></div>
                    <small>Selected</small>
                </li>
                <li>
                    <div class="seat sold"></div>
                    <small>Sold</small>
                </li>
            </ul>

            <div class="container">
                <div class="screen"></div>
                @foreach ($seatPrices as $seatType => $price)
                    @for ($row = 1; $row <= 2; $row++)
                        <div class="row">
                            @for ($seatNumber = 1; $seatNumber <= 10; $seatNumber++)
                                <div class="seat" data-seat-type="{{ $seatType }}"
                                    data-seat-price="{{ $price }}">
                                    <span class="seat-label"
                                        data-seat-type="{{ $seatType }}">{{ $seatType }}</span>
                                </div>
                            @endfor
                        </div>
                    @endfor
                    <br />
                @endforeach
            </div>
            
            <div class="seat-information">
                <p class="text">
                    You have selected <span id="count">0</span> seat(s) with number(s): <span id="seatNumbers"></span>
                    for a
                    total price of RM <span id="total">0</span>
                </p>

                <button class="addtocart" type="submit">
                    <div class="pretext">
                        <i class="fas fa-cart-plus"></i> ADD TO CART
                    </div>

                    <div class="pretext done">
                        <div class="posttext"><i class="fas fa-check"></i> ADDED</div>
                    </div>
                </button>
            </div>
        </form>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.querySelector(".addtocart");
            const done = document.querySelector(".done");
            let added = false;

            var soldSeatNumbers = @json($soldSeatNumbers);
            console.log('Sold Seat Numbers:', soldSeatNumbers);

            button.addEventListener('click', () => {
                if (added && selectedSeats.length > 0) {
                    done.style.transform = "translate(-110%) skew(-40deg)";
                    added = false;
                } else if (selectedSeats.length > 0) {
                    done.style.transform = "translate(0px)";
                    added = true;
                }
            });

            var selectedSeats = []; // To store selected seat information
            var form = document.querySelector('.bookingForm');

            //  Add a click event listener to all seats with the 'seat' class
            document.querySelectorAll('.seat').forEach(function(seat, index) {
                // Calculate seat number based on row and seat number
                var seatNumber = String.fromCharCode(65 + Math.floor(index / 10)) + (index %
                    10 + 1);

                // Check if the seat is already sold
                if (soldSeatNumbers.includes(seatNumber)) {
                    console.log('Sold seat: ' + seatNumber);
                    // Highlight the seat that is already sold by adding a class
                    seat.classList.add('sold');
                }

                seat.addEventListener('click', function() {
                    // Check if the seat is already sold
                    if (soldSeatNumbers.includes(seatNumber)) {
                        alert('Seat ' + seatNumber + ' has already been sold.');
                        return;
                    }

                    // Toggle seat selection
                    seat.classList.toggle('selected');

                    // Get seat type and price from data attributes
                    var seatType = seat.getAttribute('data-seat-type');
                    var seatPrice = parseFloat(seat.getAttribute('data-seat-price'));

                    // Update selectedSeats array
                    if (seat.classList.contains('selected')) {
                        selectedSeats.push({
                            number: seatNumber,
                            type: seatType,
                            price: seatPrice
                        });
                    } else {
                        // Remove the seat from selectedSeats array if unselected
                        selectedSeats = selectedSeats.filter(function(selectedSeat) {
                            return selectedSeat.number !== seatNumber;
                        });
                    }

                    // Update the selected seat information on the page
                    updateSelectedSeatsInfo();
                });
            });

            function updateSelectedSeatsInfo() {
                var countElement = document.getElementById('count');
                var seatNumbersElement = document.getElementById('seatNumbers');
                var totalElement = document.getElementById('total');
                var seatQuantityInput = document.querySelector('input[name="seat_quantity"]');
                var seatNumberInput = document.querySelector('input[name="seat_number"]');
                var totalPriceInput = document.querySelector('input[name="total_price"]');

                // Check if the elements exist in the DOM
                if (!countElement || !seatNumbersElement || !totalElement || !seatQuantityInput || !
                    seatNumberInput || !totalPriceInput) {
                    console.error("Elements not found in the DOM");
                    return;
                }

                // Update count and total based on selected seats
                var totalCount = selectedSeats.length;
                var totalAmount = selectedSeats.reduce(function(sum, seat) {
                    return sum + seat.price;
                }, 0);

                // Update seat numbers
                var seatNumbers = selectedSeats.map(function(seat) {
                    return seat.number;
                });

                // Display selected seat information in the specified <p> element
                countElement.textContent = totalCount;
                seatNumbersElement.textContent = seatNumbers.join(', ');
                totalElement.textContent = totalAmount.toFixed(2);

                // Display selected seat information in the input fields
                seatQuantityInput.value = totalCount;
                seatNumberInput.value = seatNumbers.join(', ');
                totalPriceInput.value = totalAmount.toFixed(2);
            }

            // Add a submit event listener to the form
            form.addEventListener('submit', function(event) {
                // Check if at least one seat is selected before allowing form submission
                if (selectedSeats.length === 0) {
                    event.preventDefault();
                    alert('Please select at least one seat before submitting the form.');
                }
            });
        });
    </script>

@endsection
