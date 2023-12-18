@extends('frontend/layout')
@section('title', 'Booking Ticket')
@section('content')
    {{-- Seat CSS --}}
    <link rel="stylesheet" href="{{ asset('seat/style.css') }}" />

    <br><br><br><br><br>
        <br><br><br><br><br>
    <br><br><br><br><br>


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
        You have selected <span id="count">0</span> seat for a price of RM <span id="total">0</span>
    </p>

    <script>
        const showcaseSeats = document.querySelectorAll('.showcase .seat');
        const containerSeats = document.querySelectorAll('.container .seat');
        const countElement = document.getElementById('count');
        const totalElement = document.getElementById('total');

        let totalTicketPrice = 0;

        showcaseSeats.forEach(seat => {
            seat.parentElement.addEventListener('click', (event) => {
                const clickedSeat = event.target.closest('.seat');

                // Check if the clicked seat is in the showcase and does not have 'cannot-select' class
                if (clickedSeat && clickedSeat.parentElement.classList.contains('showcase') && !clickedSeat.classList.contains('cannot-select')) {
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
    </script>

@endsection