

@extends('frontend/layout')
@section('title', 'View Concert Detail')
@section('content')

<!-- Begin Concert Information -->
<div class="container concert-information ">
    <div class="card shadow">
        <div class="container-fluid">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <div class="preview-pic tab-content">
                        @foreach(json_decode($concerts->images) as $index => $image)
                            <div class="tab-pane active" id="pic-1"><img src="{{ asset('images/' . $image) }}" /></div>
                            @if($index === 0) {{-- Break out of the loop after the first iteration --}}
                                    @break
                                @endif
                            @endforeach
                        {{-- <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
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
                    </ul> --}}

                    <ul class="preview-thumbnail nav nav-tabs">
                        @foreach(json_decode($concerts->images) as $index => $image)
                            <li class="{{ $index === 0 ? 'active' : '' }}">
                                <a data-target="#pic-{{ $index + 1 }}" data-toggle="tab">
                                    <img src="{{ asset('images/' . $image) }}" />
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">{{ $concerts->name }}</h3>
                    <div class="rating">
                        <div class="stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <span class="review-no">41 reviews</span>
                    </div>
                    <p class="product-description">Description : {{ $concerts->description }}</p>
                    <h4 class="price">Date and Time : <span>{{ $concerts->date_time }}</span></h4>
                    <p class="vote"><strong>Venue</strong>: <strong>{{ $concerts->venue }}</strong></p>
                    <h5 class="sizes">Organizer Name:
                        <span class="size" data-toggle="tooltip" title="small">{{ $concerts->organizer_name }}</span>
                        {{-- <span class="size" data-toggle="tooltip" title="medium">m</span>
                        <span class="size" data-toggle="tooltip" title="large">l</span>
                        <span class="size" data-toggle="tooltip" title="xtra large">xl</span> --}}
                    </h5>

                    <a href="{{ url('/bookingConcert/' .$concerts->id)}}"><button type="submit" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i>Book Now</button></a>

                    {{-- <h5 class="colors">colors:
                        <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                        <span class="color green"></span>
                        <span class="color blue"></span>
                    </h5> --}}

                </div>
            </div>
        </div>
    </div>
</div>

<br><br>

@endsection
