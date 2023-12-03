<head>
    <title>Add Concert Date</title>
    <link href="/backend/assets/css/add_date.css" rel="stylesheet" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('/backend/assets/js/add_date.js')}}"></script>
    <!-- <script src="//code.jquery.com/jquery-3.7.1.slim.min.js"></script> -->

</head>
@extends('backend/layouts/commonMaster')
@section('layoutContent')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Concert Date</h1>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <!--Date input start-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-date-input-wrap">
                                <div class="main-date-input fl-wrap">
                                    <div class="main-date-input-item">
                                        <input type="datetime-local" id="date-list-item" name="date-list-item">
                                    </div>
                                    <button class="add-items main-search-button">ADD</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Date item list start-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-date-input-wrap">
                                <div class="main-date-input fl-wrap date-listing">
                                    <ul id="list-items"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Date item list end-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Content -->
@endsection