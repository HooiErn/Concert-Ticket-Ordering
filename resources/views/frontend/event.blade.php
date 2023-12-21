@extends('frontend/layout')
@section('title', 'Event')
@section('content')

    <!-- Preloader -->
    {{-- <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div> --}}

    <!-- ##### Breadcumb Area Start ##### -->
    {{-- <section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="bradcumbContent">
            <p>See what’s new</p>
            <h2>Events</h2>
        </div>
    </section> --}}
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Events Area Start ##### -->
    {{-- <section class="events-area section-padding-100">
        <div class="container">
            <div class="row">

                <!-- Single Event Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-event-area mb-30">
                        <div class="event-thumbnail">
                            <img src="img/bg-img/e1.jpg" alt="">
                        </div>
                        <div class="event-text">
                            <h4>Dj Night Party</h4>
                            <div class="event-meta-data">
                                <a href="#" class="event-place">VIP Sala</a>
                                <a href="#" class="event-date">June 15, 2018</a>
                            </div>
                            <a href="#" class="btn see-more-btn">See Event</a>
                        </div>
                    </div>
                </div>

                <!-- Single Event Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-event-area mb-30">
                        <div class="event-thumbnail">
                            <img src="img/bg-img/e2.jpg" alt="">
                        </div>
                        <div class="event-text">
                            <h4>The Mission</h4>
                            <div class="event-meta-data">
                                <a href="#" class="event-place">Gold Arena</a>
                                <a href="#" class="event-date">June 15, 2018</a>
                            </div>
                            <a href="#" class="btn see-more-btn">See Event</a>
                        </div>
                    </div>
                </div>

                <!-- Single Event Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-event-area mb-30">
                        <div class="event-thumbnail">
                            <img src="img/bg-img/e3.jpg" alt="">
                        </div>
                        <div class="event-text">
                            <h4>Planet ibiza</h4>
                            <div class="event-meta-data">
                                <a href="#" class="event-place">Space Ibiza</a>
                                <a href="#" class="event-date">June 15, 2018</a>
                            </div>
                            <a href="#" class="btn see-more-btn">See Event</a>
                        </div>
                    </div>
                </div>

                <!-- Single Event Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-event-area mb-30">
                        <div class="event-thumbnail">
                            <img src="img/bg-img/e4.jpg" alt="">
                        </div>
                        <div class="event-text">
                            <h4>Dj Night Party</h4>
                            <div class="event-meta-data">
                                <a href="#" class="event-place">VIP Sala</a>
                                <a href="#" class="event-date">June 15, 2018</a>
                            </div>
                            <a href="#" class="btn see-more-btn">See Event</a>
                        </div>
                    </div>
                </div>

                <!-- Single Event Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-event-area mb-30">
                        <div class="event-thumbnail">
                            <img src="img/bg-img/e5.jpg" alt="">
                        </div>
                        <div class="event-text">
                            <h4>The Mission</h4>
                            <div class="event-meta-data">
                                <a href="#" class="event-place">Gold Arena</a>
                                <a href="#" class="event-date">June 15, 2018</a>
                            </div>
                            <a href="#" class="btn see-more-btn">See Event</a>
                        </div>
                    </div>
                </div>

                <!-- Single Event Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-event-area mb-30">
                        <div class="event-thumbnail">
                            <img src="img/bg-img/e6.jpg" alt="">
                        </div>
                        <div class="event-text">
                            <h4>Planet ibiza</h4>
                            <div class="event-meta-data">
                                <a href="#" class="event-place">Space Ibiza</a>
                                <a href="#" class="event-date">June 15, 2018</a>
                            </div>
                            <a href="#" class="btn see-more-btn">See Event</a>
                        </div>
                    </div>
                </div>

                <!-- Single Event Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-event-area mb-30">
                        <div class="event-thumbnail">
                            <img src="img/bg-img/e7.jpg" alt="">
                        </div>
                        <div class="event-text">
                            <h4>Dj Night Party</h4>
                            <div class="event-meta-data">
                                <a href="#" class="event-place">VIP Sala</a>
                                <a href="#" class="event-date">June 15, 2018</a>
                            </div>
                            <a href="#" class="btn see-more-btn">See Event</a>
                        </div>
                    </div>
                </div>

                <!-- Single Event Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-event-area mb-30">
                        <div class="event-thumbnail">
                            <img src="img/bg-img/e8.jpg" alt="">
                        </div>
                        <div class="event-text">
                            <h4>The Mission</h4>
                            <div class="event-meta-data">
                                <a href="#" class="event-place">Gold Arena</a>
                                <a href="#" class="event-date">June 15, 2018</a>
                            </div>
                            <a href="#" class="btn see-more-btn">See Event</a>
                        </div>
                    </div>
                </div>

                <!-- Single Event Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-event-area mb-30">
                        <div class="event-thumbnail">
                            <img src="img/bg-img/e9.jpg" alt="">
                        </div>
                        <div class="event-text">
                            <h4>Planet ibiza</h4>
                            <div class="event-meta-data">
                                <a href="#" class="event-place">Space Ibiza</a>
                                <a href="#" class="event-date">June 15, 2018</a>
                            </div>
                            <a href="#" class="btn see-more-btn">See Event</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="load-more-btn text-center mt-70">
                        <a href="#" class="btn oneMusic-btn">Load More <i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- ##### Events Area End ##### -->

    <!-- ##### Latest Concerts Area Start ##### -->
    <div class="concert-container">
        @foreach ($concerts as $concert)
            <div class="concert">
                <div class='concert-main'>
                    <img class='concert-image' src="{{ asset('images/' . json_decode($concert->images)[0]) }}"
                        alt="{{ $concert->name }} Image" />
                    <h2 class="concert-title">{{ $concert->name }}</h2>
                    <p class='concert-description'>{{ $concert->description }}</p>
                    <div class='concert-info'>
                        <div class="concert-price">
                            <ins style="color:#D4C108 ; margin-top:-4px">$</ins>
                            @php
                                $minPrice = $concert->sortedTicketTypes->first()->price;
                                $maxPrice = $concert->sortedTicketTypes->last()->price;
                            @endphp

                            <p>From RM{{ $minPrice }} to RM{{ $maxPrice }}</p>
                        </div>
                        <div class="concert-duration">
                            <ins style="color:#C82707; margin-top:-4px"">◷</ins>
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
    </div>
    <!-- ##### Latest Concerts Area End ##### -->


@endsection
