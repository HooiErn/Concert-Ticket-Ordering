@extends('frontend/layout')
@section('title', 'Event')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img bg-overlay"
        style="background-image: url(img/bg-img/breadcumb3.jpg); height: 200px;">
        <div class="bradcumbContent">
            <p>See what’s new</p>
            <h2>Events</h2>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->
    <!-- ##### Latest Concerts Area Start ##### -->
    <div class="concert-container">
        @if ($concerts->count() > 0)
            @foreach ($concerts as $concert)
                <div class="concert" style="margin: 100px 0 70px 0">
                    <div class='concert-main'>
                        <img class='concert-image' src="{{ asset('images/' . json_decode($concert->images)[0]) }}"
                            alt="{{ $concert->name }} Image" />
                        <h2 class="concert-title">{{ $concert->name }}</h2>
                        <p class='concert-description'>{{ $concert->description }}</p>
                        <div class='concert-info'>
                            @if ($concert->sortedTicketTypes && $concert->sortedTicketTypes->count() > 0)
                                @php
                                    $minPrice = $concert->sortedTicketTypes->first()->price;
                                    $maxPrice = $concert->sortedTicketTypes->last()->price;
                                @endphp
                                <div class="concert-price">
                                    <ins style="color:#D4C108 ; margin-top:-4px">$</ins>
                                    <p>From RM{{ $minPrice }} to RM{{ $maxPrice }}</p>
                                </div>
                            @else
                                <p style="text-align: center; font-size:24px">No Ticket Found</p>
                            @endif

                            <div class="concert-duration">
                                <ins style="color:#C82707; margin-top:-4px">◷</ins>
                                <p>{{ \Carbon\Carbon::parse($concert->date_time)->diffForHumans() }}</p>
                            </div>
                        </div>
                        <hr />
                        <div class='concert-creator'>
                            <p style="color:#C9C3C2; font-family: 'Oswald', sans-serif;">Organized by <span
                                    style="color: #DAA520; font-size:18px;font-family: 'Oswald', sans-serif;">{{ $concert->organizer_name }}</span>
                            </p>
                        </div>
                        <div class='concert-info'>
                            <div class="concert-action-container">
                                <p>{{ \Carbon\Carbon::parse($concert->date_time)->format('D, M d, Y h:i A') }}</p>
                                <a href="{{ url('/viewConcert/' . $concert->id) }}" class="concert-action">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p style="margin-top:40px; font-size:24px; display:block">No Events Found</p>
        @endif
    </div>
    <!-- ##### Latest Concerts Area End ##### -->


@endsection
