@extends('frontend/layout')
@section('title', 'View Concert Detail')
@section('content')
<link rel="stylesheet" href="{{ asset('css/ticket.css') }}">

<!-- ##### Breadcumb Area Start ##### -->
<section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg); height: 200px;">
    <div class="bradcumbContent">
        <p>See what you have purchased </p>
        <h2>Ticket History</h2>
    </div>
</section>
    <!-- ##### Breadcumb Area End ##### -->
<section class="ticket-section">
@foreach ($userTickets as $ticket)
<div class="ticket created-by-anniedotexe">
	<div class="left">

		<div class="ticket-image" style="background-image: url('{{ asset('images/' . json_decode($ticket->concert->images)[0]) }}');">
			<p class="admit-one">
				<span>ADMIT ONE</span>
				<span>ADMIT ONE</span>
				<span>ADMIT ONE</span>
			</p>
			<div class="ticket-number">
				<p>
					#20030220
				</p>
			</div>
		</div>
		<div class="ticket-info">
			<p class="ticket-date">
    			<span>{{ \Carbon\Carbon::parse($ticket->concert->date_time)->format('l') }}</span> <!--format('l') returns the day of the week (e.g., Tuesday). -->
				<span class="june-29">{{ \Carbon\Carbon::parse($ticket->concert->date_time)->format('F j') }}</span> <!--format('F j') returns the month (e.g., June) and day (e.g., 29). -->
				<span>{{ \Carbon\Carbon::parse($ticket->concert->date_time)->format('Y') }}</span> <!-- format('Y') returns the year. -->
			</p>
			<div class="ticket-show-name">
				<h1>{{$ticket->concert->name }}</h1>
				<h2>{{$ticket->concert->organizer_name }}</h2>
			</div>
			<div class="ticket-time">
				<p>{{ \Carbon\Carbon::parse($ticket->concert->date_time)->diffForHumans() }}</p>
				<!-- <p>8:00 PM <span>TO</span> 11:00 PM</p>
				<p>DOORS <span>@</span> 7:00 PM</p> -->
			</div>
			<p class="ticket-location">{{ $ticket->concert->description }}</p>
		</div>
	</div>
	<div class="right">
		<div class="right-info-container">
			<!-- <div class="ticket-show-name">
				<h1>SOUR Prom</h1>
			</div> -->
			
			<div class="ticket-time">
				<p style="font-weight:500">Start from: <span style=" color: #d83565; font-weight:bold">{{ \Carbon\Carbon::parse($ticket->concert->date_time)->format('g:i A') }}</span></p>
			</div>
			<div class="ticket-barcode">
				<img src="https://external-preview.redd.it/cg8k976AV52mDvDb5jDVJABPrSZ3tpi1aXhPjgcDTbw.png?auto=webp&s=1c205ba303c1fa0370b813ea83b9e1bddb7215eb" alt="QR code">
			</div>
			<p class="ticket-number">
				{{ $ticket->ticket_id }}
			</p>
			<div class="ticket-time">
				<p style="color: #d83565; font-weight:bold">{{ $ticket->seat_numbers }}</p>
			</div>
			<button class="navy-blue-button">Verify Now</button>
		</div>
	</div>
</div>
@endforeach
</section>
@endsection