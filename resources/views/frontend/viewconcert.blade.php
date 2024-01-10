@extends('frontend/layout')
@section('title', 'View Concert Detail')
<!-- Include Bootstrap 3 stylesheet for this specific view -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

@section('content')

<!-- Begin Concert Information -->
<div>
<div class="container concert-information">
    <div class="card shadow" style="margin-top:120px">
        <div class="container-fluid">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <div id="image-carousel" class="carousel slide">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            @foreach(json_decode($concerts->images) as $index => $image)
                                <div class="item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('images/' . $image) }}" alt="Slide {{ $index + 1 }}"
                                     class="img-responsive" style="height: 250px; width: 500px; object-fit: contain;">
                                </div>
                            @endforeach
                        </div>
                    <!-- {{-- <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
                        <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
                        <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
                        <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div> --}}
                    </div>

                    {{-- <ul class="preview-thumbnail nav nav-tabs">
                        <li class="active">
                            <a data-target="#pic-1" data-toggle="tab">
                                @foreach(json_decode($concerts->images) as $index => $image)
                                    <img src="{{ asset('images/' . $image) }}" /></a>
                                @if($index === 0)
                                    @break
                                @endif
                            @endforeach
                        </li>
                        <li>
                            <a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a>
                        </li>
                        <li>
                            <a data-target="#pic-3" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a>
                        </li>
                        <li>
                            <a data-target="#pic-4" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a>
                        </li>
                        <li>
                            <a data-target="#pic-5" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a>
                        </li>
                    </ul> --}} -->
                    
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#image-carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#image-carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                        <!-- Thumbnail navigation -->
                        <ul class="preview-thumbnail nav nav-tabs">
                            @foreach(json_decode($concerts->images) as $index => $image)
                                <li data-target="#image-carousel" data-slide-to="{{ $index }}"
                                    class="{{ $index === 0 ? 'active' : '' }} d-flex justify-content-center align-items-center">
                                    <a>
                                        <img src="{{ asset('images/' . $image) }}" alt="Thumbnail {{ $index + 1 }}"
                                         class="img-responsive" style="height: 50px; width: 50px; object-fit: contain;">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">{{ $concerts->name }}</h3>
                    <div class="rating">
                        <div class="stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                        <span class="review-no">41 reviews</span>
                    </div>
                    <p class="product-description">Description : {{ $concerts->description }}</p>
                    <h4 class="price">Date and Time : <span>{{ $concerts->date_time }}</span></h4>
                    <p class="vote"><strong>Venue</strong>: <strong>{{ $concerts->venue }}</strong></p>
                    <h5 class="sizes">Organizer Name:
                        <span class="size" data-toggle="tooltip" title="small">{{ $concerts->organizer_name }}</span>
                    </h5>

                    <a href="{{ url('/bookingConcert/' .$concerts->id)}}"><button type="submit" class="btn bg-cart btn-lg"
                    style="transition: background-color 0.3s;"onmouseover="this.style.backgroundColor='#ff9f1a';" onmouseout="this.style.backgroundColor='';">
                    <i class="fa fa-cart-plus mr-2"></i>Book Now</button></a>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
