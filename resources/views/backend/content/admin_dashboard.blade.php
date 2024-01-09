<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var areaChartData = {!! json_encode($areaChartData)!!};

        var topThreeConcerts = {!! json_encode($topThreeConcerts) !!};

        // Extract the concert names and total seats sold from the data
        var concertNames = topThreeConcerts.map(concert => concert.concert_name);
        var totalSeatsSold = topThreeConcerts.map(concert => concert.total_seats_sold);
    </script>
</head>
@extends('backend/layouts/commonMaster')
@section('layoutContent')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Ticket Sold (Today)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalSeats}} pcs</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-ticket-perforated-fill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Earnings (Today)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{$dailyTotal}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-currency-dollar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Earnings (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{$monthlyTotal}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-coin fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Earnings (Annual)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{$annualTotal}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Top Selling Concert</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                @foreach($topThreeConcerts as $index => $concert)
                <div class="row mt-1">
                    <div class="col-md-12">
                        <h6 class="font-weight-bold"> <i class="bi @if($index == 0) bi-1-circle-fill text-primary @elseif($index == 1) bi-2-circle-fill text-success @elseif($index == 2) bi-3-circle-fill text-danger @endif"></i>  {{$concert->concert_name}} - {{$concert->total_seats_sold}} pcs</h6>
                    </div>
                </div>
                @endforeach
                <!-- <div class="chart-pie pt-4 pb-2">
                    <canvas id="myBarChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Referral
                    </span>
                </div> -->
            </div>
        </div>
    </div>
</div>



</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<!-- Page level plugins -->
<script src="/backend/assets/vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src='/backend/assets/js/demo/chart-area-demo.js'></script>
<script src="{{ asset('/backend/assets/js/demo/chart-pie-demo.js')}}"></script>
<script src="{{ asset('/backend/assets/js/demo/chart-bar-demo.js')}}"></script>

<!-- End of session('content') -->
@endsection