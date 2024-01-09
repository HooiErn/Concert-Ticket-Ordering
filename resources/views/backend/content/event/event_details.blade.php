<head>
    <title>Concerts</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link href="/backend/assets/css/event_details.css" rel="stylesheet" />
    <link href="/backend/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- <script>$encodedChartData = json_encode($chartData);</script> -->
    <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->
    <script>
        var ticketTypeChart = {!! json_encode($ticketTypeChart)!!};
    </script>
</head>
@extends('backend/layouts/commonMaster')
@section('layoutContent')

<!-- Begin Concert Information -->
<div class="container concert-information">
    <div class="card shadow">
        <div class="container-fluid">
            <div class="wrapper row">
                <div class="preview col-md-5">
                    <div class="tab-content">
                        @foreach(json_decode($concerts->images) as $index => $image)
                        @if($index === 0)
                        <div class="tab-pane active" id="pic-1">
                            <img src="{{ asset('images/' . $image) }}" />
                        </div>
                        @else
                        <div class="tab-pane" id="pic-{{ $index + 1 }}">
                            <img src="{{ asset('images/' . $image) }}" />
                        </div>
                        @endif
                        @endforeach
                    </div>

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
                <div class="details col-md-7">
                    <h3 class="product-title">{{ $concerts->name }}</h3>
                    <h5 class="text-secondary">
                        {{ $concerts->organizer_name }}
                    </h5>
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
                    <h5 class="price"><span><i class="bi bi-calendar-event mr-2"></i>{{ $concerts->date_time }}</span>
                    </h5>
                    <p class="vote"><strong><i class="bi bi-geo-alt mr-2"></i></strong><strong>{{ $concerts->venue
                            }}</strong></p>
                    <p class="product-description">{{ $concerts->description }}</p>


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

<!-- End Concert Information -->
<div class="container-fluid mt-5 mb-5">
    <div class="row d-flex ">
        <div class="col-md-6">
            <div class="card border-left-primary shadow py-2 ticket-type-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{$totalRevenue}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-coin fa-2x "></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-left-info shadow py-2 ticket-type-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Ticket Ordered</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalOrdered}} pcs</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-ticket-perforated-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-left-success shadow py-2 ticket-type-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ticket Left</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalTicketLeft}} pcs</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-ticket-perforated fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card ticket-type-selling shadow">
                <div class="mb-1 text-center small">
                    Ticket Type Selling Information
                </div>
                <div><canvas id="myChart" style="width:100%;" class="mt-2"></canvas></div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> VIP
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> CAT1
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> CAT2
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> CAT3
                    </span>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- DataTales Example -->
<div class="container-fluid">
    <div class="row">
        <div class="card shadow mb-4 ticket-type-info">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Sales</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-ticket-type-info" id="ticket-type-table" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Ticket Type</th>
                                <th>Price</th>
                                <th>Total Ordered</th>
                                <th>Total Left</th>
                                <th>Total Seat</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ticketTypes as $ticketType)
                            <tr>
                                <td>{{$ticketType->name}}</td>
                                <td>$ {{$ticketType->price}}</td>
                                <td>{{$ticketType->total-$ticketType->available}}</td>
                                <td>{{$ticketType->available}}</td>
                                <td>{{$ticketType->total}}</td>
                                <td>$ {{$ticketType->price*($ticketType->total-$ticketType->available)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="{{ asset('/backend/assets/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{ asset('/backend/assets/js/demo/chart-dougnut-ticket-type.js')}}"></script>
@endsection
