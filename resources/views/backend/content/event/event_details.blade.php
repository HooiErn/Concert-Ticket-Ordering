<head>
    <title>Concerts</title>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->
    <link href="/backend/assets/css/event_details.css" rel="stylesheet" />
    <link href="/backend/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
@extends('backend/layouts/commonMaster')
@section('layoutContent')
<!-- Begin Concert Information -->
<div class="container concert-information">
    <div class="card shadow">
        <div class="container-fluid">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1"><img src="http://placekitten.com/400/252" /></div>
                        <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
                        <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
                        <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
                        <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div>
                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                        <li class="active"><a data-target="#pic-1" data-toggle="tab"><img
                                    src="http://placekitten.com/200/126" /></a></li>
                        <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a>
                        </li>
                        <li><a data-target="#pic-3" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a>
                        </li>
                        <li><a data-target="#pic-4" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a>
                        </li>
                        <li><a data-target="#pic-5" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a>
                        </li>
                    </ul>

                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">men's shoes fashion</h3>
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
                    <p class="product-description">Suspendisse quos? Tempus cras iure temporibus? Eu laudantium cubilia
                        sem sem! Repudiandae et! Massa senectus enim minim sociosqu delectus posuere.</p>
                    <h4 class="price">current price: <span>$180</span></h4>
                    <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
                    <h5 class="sizes">sizes:
                        <span class="size" data-toggle="tooltip" title="small">s</span>
                        <span class="size" data-toggle="tooltip" title="medium">m</span>
                        <span class="size" data-toggle="tooltip" title="large">l</span>
                        <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
                    </h5>
                    <h5 class="colors">colors:
                        <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                        <span class="color green"></span>
                        <span class="color blue"></span>
                    </h5>

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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-left-primary shadow py-2 ticket-type-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Ticket Ordered</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-left-primary shadow py-2 ticket-type-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Ticket Left</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card ticket-type-selling shadow">
                <canvas id="myChart" style="width:100%;"></canvas>
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
                    <table class="table table-bordered table-ticket-type-info" id="ticket-type-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Ticket Type</th>
                                <th>Price</th>
                                <th>Total Ordered</th>
                                <th>Total Left</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection