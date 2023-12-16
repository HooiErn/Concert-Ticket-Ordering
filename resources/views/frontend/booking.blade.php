@extends('frontend/layout')
@section('title', 'Booking Ticket')
@section('content')

    {{-- Seat CSS --}}
    <link rel="stylesheet" href="{{ asset('seat/style.css') }}" />

    <br><br><br><br><br>

    <div class="movie-container">
        <label>Concert Name:</label>
        {{-- <label value="{{ $concerts_id->id }}">{{ $concerts_id->name }}</label> --}}
        <select id="movie">
            <option value="{{ $concerts_id->id }}">{{ $concerts_id->name }}</option>
            {{-- <option value="320">Radhe (RS.320)</option>
            <option value="250">RRR (RS.250)</option>
            <option value="260">F9 (RS.260)</option> --}}
        </select>
    </div>

    <ul class="showcase">
        <li>
            <div class="seat"></div>
            <small>Available</small>
        </li>
        <li>
            <div class="seat selected"></div>
            <small>Selected</small>
        </li>
        <li>
            <div class="seat sold"></div>
            <small>Sold</small>
        </li>
    </ul>

    <div class="container">

        <div class="screen"></div>

        <div class="row">
            <div class="seat" value="1"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat sold"></div>
            <div class="seat sold"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat sold"></div>
            <div class="seat sold"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat sold"></div>
            <div class="seat sold"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
        </div>
        <div class="row">
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat"></div>
            <div class="seat sold"></div>
            <div class="seat sold"></div>
            <div class="seat sold"></div>
            <div class="seat"></div>
        </div>

    </div>

    <p class="text">
        You have selected <span id="count">0</span> seat for a price of RS.<span id="total">0</span>
    </p>

    {{-- Seat JS --}}
    {{-- <script src="{{ asset('seat/script.js') }}"></script> --}}

    {{-- <script>
        const container = document.querySelector(".container");
        const seats = document.querySelectorAll(".row .seat:not(.sold)");
        const count = document.getElementById("count");
        const total = document.getElementById("total");
        const movieSelect = document.getElementById("movie");

        console.log('seat',seats);

        populateUI();

        let ticketPrice = +movieSelect.value;

        function setMovieData(movieIndex, moviePrice) {
            localStorage.setItem("selectedMovieIndex", movieIndex);
            localStorage.setItem("selectedMoviePrice", moviePrice);
        }

        function updateSelectedCount() {
            const selectedSeats = document.querySelectorAll(".row .seat.selected");
            const seatsIndex = Array.from(selectedSeats).map((seat) => Array.from(seats).indexOf(seat));

            console.log("Selected Seats Index:", seatsIndex);

            localStorage.setItem("selectedSeats", JSON.stringify(seatsIndex));

            const selectedSeatsCount = selectedSeats.length;
            count.innerText = selectedSeatsCount;
            total.innerText = selectedSeatsCount * ticketPrice;

            console.log("Selected Seats Count:", selectedSeatsCount);

            setMovieData(movieSelect.selectedIndex, movieSelect.value);
        }


        function populateUI() {
            const selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));

            if (selectedSeats && selectedSeats.length > 0) {
                selectedSeats.forEach((index) => {
                    seats[index].classList.add("selected");
                });
            }

            const selectedMovieIndex = localStorage.getItem("selectedMovieIndex");

            if (selectedMovieIndex !== null) {
                movieSelect.selectedIndex = selectedMovieIndex;
            }
        }

        movieSelect.addEventListener("change", (e) => {
            ticketPrice = +e.target.value;
            setMovieData(e.target.selectedIndex, e.target.value);
            updateSelectedCount();
        });

        container.addEventListener("click", (e) => {
            if (e.target.classList.contains("seat") && !e.target.classList.contains("sold")) {
                e.target.classList.toggle("selected");
                updateSelectedCount();
            }
        });

        updateSelectedCount();
    </script> --}}

    <script>
        const seats = document.querySelectorAll('.seat');
        let ticketPrice = 10; // Set your ticket price

        seats.forEach(seat => {
            seat.addEventListener('click', () => {
                if (!seat.classList.contains('sold')) {
                    seat.classList.toggle('selected');
                    updateSelectedCount();
                }
            });
        });

        function updateSelectedCount() {
            const selectedSeats = document.querySelectorAll('.seat.selected');
            const selectedSeatsCount = selectedSeats.length;

            const countElement = document.getElementById('count');
            const totalElement = document.getElementById('total');

            // Update UI to show selected seat count and total price
            countElement.textContent = selectedSeatsCount;
            totalElement.textContent = selectedSeatsCount * ticketPrice;
        }
    </script>


@endsection
