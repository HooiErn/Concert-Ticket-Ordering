@extends('frontend/layout')
@section('title', 'Booking Ticket')
@section('content')
    {{-- Seat CSS --}}
    <link rel="stylesheet" href="{{ asset('seat/style.css') }}" />

    <br><br><br><br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>

    <form action="{{ url('/AddToCart') }}" method="post">
        @csrf

        <input type="text" name="concert_id" value="{{ $concert->id }}">
        <input type="text" name="concert_name" value="{{ $concert->name }}">
        <input type="text" name="seat_quantity" value="">
        <input type="text" name="seat_number" value="">
        <input type="text" name="total_price" value="">
        <input type="text" name="user_name" value="{{ auth()->user()->name }}">
        <input type="text" name="user_id" value="{{ auth()->user()->id }}">

        <div class="movie-container">
            <label>Concert Name:</label>
            <select id="movie" data-concert-id="{{ $concert->id }}">
                <option value="{{ $concert->id }}">{{ $concert->name }}</option>
            </select>
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
                            <div class="seat" data-seat-type="{{ $seatType }}" data-seat-price="{{ $price }}">
                                <span class="seat-label" data-seat-type="{{ $seatType }}">{{ $seatType }}</span>
                            </div>
                        @endfor
                    </div>
                @endfor
                <br />
            @endforeach
        </div>

        <p class="text">
            {{-- You have selected <span id="count">0</span> seat for a price of RM <span id="total">0</span> --}}
        </p>

        <p class="text">
            You have selected <span id="count">0</span> seat(s) with number(s): <span id="seatNumbers"></span> for a total price of RM <span id="total">0</span>
        </p>

        {{-- <p class="text">
            You have selected <span id="count">0</span> seat for a price of RM <span id="total">0</span>
        </p> --}}

        <button type="submit" class="btn btn-primary" style="background-color:#242333 ; background-size: cover;">
             Add To Cart
        </button>

    </form>

    {{-- <script>
        const showcaseSeats = document.querySelectorAll('.showcase .seat');
        const containerSeats = document.querySelectorAll('.container .seat');
        const countElement = document.getElementById('count');
        const totalElement = document.getElementById('total');

        let totalTicketPrice = 0;

        showcaseSeats.forEach(seat => {
            seat.parentElement.addEventListener('click', (event) => {
                const clickedSeat = event.target.closest('.seat');

                // Check if the clicked seat is in the showcase and does not have 'cannot-select' class
                if (clickedSeat && clickedSeat.parentElement.classList.contains('showcase') && !clickedSeat
                    .classList.contains('cannot-select')) {
                    const isSold = clickedSeat.classList.contains('sold');
                    if (!isSold) {
                        const seatType = clickedSeat.getAttribute('data-seat-type');
                        const seatPrice = parseFloat(clickedSeat.getAttribute('data-seat-price')) || 0;

                        clickedSeat.classList.toggle('selected');
                        updateSelectedCount(seatType, seatPrice);
                    }
                }
            });
        });

        containerSeats.forEach(seat => {
            seat.addEventListener('click', () => {
                const isSold = seat.classList.contains('sold');
                if (!isSold) {
                    const seatType = seat.getAttribute('data-seat-type');
                    const seatPrice = parseFloat(seat.getAttribute('data-seat-price')) || 0;

                    seat.classList.toggle('selected');
                    updateSelectedCount(seatType, seatPrice);
                }
            });
        });

        function updateSelectedCount() {
            const selectedSeats = document.querySelectorAll('.seat.selected');
            const selectedSeatsCount = selectedSeats.length;

            countElement.textContent = selectedSeatsCount;

            // Update UI to show selected seat count and total price
            totalTicketPrice = 0;

            selectedSeats.forEach(selectedSeat => {
                const seatPrice = parseFloat(selectedSeat.getAttribute('data-seat-price')) || 0;
                totalTicketPrice += seatPrice;
            });

            totalElement.textContent = totalTicketPrice;
        }
    </script> --}}

    <!-- Add this script section at the end of your HTML file -->
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedSeats = []; // To store selected seat information

            // Add a click event listener to all seats with the 'seat' class
            document.querySelectorAll('.seat').forEach(function(seat) {
                seat.addEventListener('click', function() {
                    // Toggle seat selection
                    seat.classList.toggle('selected');

                    // Get seat type and price from data attributes
                    var seatType = seat.getAttribute('data-seat-type');
                    var seatPrice = parseFloat(seat.getAttribute('data-seat-price'));

                    // Get seat number from the seat label text
                    var seatNumber = seat.querySelector('.seat-label').textContent.trim();

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

                    console.log(selectedSeats);

                    // Update the selected seat information on the page
                    updateSelectedSeatsInfo();
                });
            });

            function updateSelectedSeatsInfo() {
                var countElement = document.getElementById('count');
                var totalElement = document.getElementById('total');

                // Update count and total based on selected seats
                var totalCount = selectedSeats.length;
                var totalAmount = selectedSeats.reduce(function(sum, seat) {
                    return sum + seat.price;
                }, 0);

                countElement.textContent = totalCount;
                totalElement.textContent = totalAmount.toFixed(2);
            }
        });
    </script> --}}

    <!-- Add this script section at the end of your HTML file -->
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedSeats = []; // To store selected seat information

            // Add a click event listener to all seats with the 'seat' class
            document.querySelectorAll('.seat').forEach(function(seat, index) {
                seat.addEventListener('click', function() {
                    // Toggle seat selection
                    seat.classList.toggle('selected');

                    // Get seat type and price from data attributes
                    var seatType = seat.getAttribute('data-seat-type');
                    var seatPrice = parseFloat(seat.getAttribute('data-seat-price'));

                    // Generate seat number based on row and seat number
                    var seatNumber = String.fromCharCode(65 + Math.floor(index / 10)) + (index %
                        10 + 1);

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

                    console.log(selectedSeats);

                    // Update the selected seat information on the page
                    updateSelectedSeatsInfo();
                });
            });

            function updateSelectedSeatsInfo() {
                var countElement = document.getElementById('count');
                var totalElement = document.getElementById('total');

                // Update count and total based on selected seats
                var totalCount = selectedSeats.length;
                var totalAmount = selectedSeats.reduce(function(sum, seat) {
                    return sum + seat.price;
                }, 0);

                countElement.textContent = totalCount;
                totalElement.textContent = totalAmount.toFixed(2);
            }
        });
    </script> --}}

    <!-- Add this script section at the end of your HTML file -->
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedSeats = []; // To store selected seat information

            // Add a click event listener to all seats with the 'seat' class
            document.querySelectorAll('.seat').forEach(function(seat, index) {
                seat.addEventListener('click', function() {
                    // Toggle seat selection
                    seat.classList.toggle('selected');

                    // Get seat type and price from data attributes
                    var seatType = seat.getAttribute('data-seat-type');
                    var seatPrice = parseFloat(seat.getAttribute('data-seat-price'));

                    // Generate seat number based on row and seat number
                    var seatNumber = String.fromCharCode(65 + Math.floor(index / 10)) + (index %
                        10 + 1);

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
                var totalElement = document.getElementById('total');

                // Check if the elements exist in the DOM
                if (!countElement || !totalElement) {
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
                totalElement.textContent = totalAmount.toFixed(2);
                document.querySelector('.text').innerHTML = 'You have selected ' + seatNumbers.join(', ') +
                    ' for a price of RM ' + totalAmount.toFixed(2);
            }
        });
    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedSeats = []; // To store selected seat information

            // Add a click event listener to all seats with the 'seat' class
            document.querySelectorAll('.seat').forEach(function(seat, index) {
                seat.addEventListener('click', function() {
                    // Toggle seat selection
                    seat.classList.toggle('selected');

                    // Get seat type and price from data attributes
                    var seatType = seat.getAttribute('data-seat-type');
                    var seatPrice = parseFloat(seat.getAttribute('data-seat-price'));

                    // Generate seat number based on row and seat number
                    var seatNumber = String.fromCharCode(65 + Math.floor(index / 10)) + (index %
                        10 + 1);

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
                var seatQuantityInput = document.querySelector('input[name="seat_quantity"]');
                var seatNumberInput = document.querySelector('input[name="seat_number"]');
                var totalPriceInput = document.querySelector('input[name="total_price"]');

                // Check if the elements exist in the DOM
                if (!seatQuantityInput || !seatNumberInput || !totalPriceInput) {
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

                // Display selected seat information in the input fields
                seatQuantityInput.value = totalCount;
                seatNumberInput.value = seatNumbers.join(', ');
                totalPriceInput.value = totalAmount.toFixed(2);
            }
        });
    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedSeats = []; // To store selected seat information

            // Add a click event listener to all seats with the 'seat' class
            document.querySelectorAll('.seat').forEach(function(seat, index) {
                seat.addEventListener('click', function() {
                    // Toggle seat selection
                    seat.classList.toggle('selected');

                    // Get seat type and price from data attributes
                    var seatType = seat.getAttribute('data-seat-type');
                    var seatPrice = parseFloat(seat.getAttribute('data-seat-price'));

                    // Generate seat number based on row and seat number
                    var seatNumber = String.fromCharCode(65 + Math.floor(index / 10)) + (index %
                        10 + 1);

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
                var totalElement = document.getElementById('total');
                var seatQuantityInput = document.querySelector('input[name="seat_quantity"]');
                var seatNumberInput = document.querySelector('input[name="seat_number"]');
                var totalPriceInput = document.querySelector('input[name="total_price"]');

                // Check if the elements exist in the DOM
                if (!countElement || !totalElement || !seatQuantityInput || !seatNumberInput || !totalPriceInput) {
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
                totalElement.textContent = totalAmount.toFixed(2);

                // Display selected seat information in the input fields
                seatQuantityInput.value = totalCount;
                seatNumberInput.value = seatNumbers.join(', ');
                totalPriceInput.value = totalAmount.toFixed(2);
            }
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedSeats = []; // To store selected seat information

            // Add a click event listener to all seats with the 'seat' class
            document.querySelectorAll('.seat').forEach(function(seat, index) {
                seat.addEventListener('click', function() {
                    // Toggle seat selection
                    seat.classList.toggle('selected');

                    // Get seat type and price from data attributes
                    var seatType = seat.getAttribute('data-seat-type');
                    var seatPrice = parseFloat(seat.getAttribute('data-seat-price'));

                    // Generate seat number based on row and seat number
                    var seatNumber = String.fromCharCode(65 + Math.floor(index / 10)) + (index %
                        10 + 1);

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
                if (!countElement || !seatNumbersElement || !totalElement || !seatQuantityInput || !seatNumberInput || !totalPriceInput) {
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
        });
    </script>








@endsection
