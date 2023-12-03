<head>
    <title>Add Concert Date</title>
    <link href="/backend/assets/css/add_ticket_type.css" rel="stylesheet" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('/backend/assets/js/add_ticketType.js')}}"></script>
    

</head>
@extends('backend/layouts/commonMaster')
@section('layoutContent')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Ticket Type</h1>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <!--Ticket Type Information input start-->
                    <div class="row main-ticket-type-input">
                        <div class="col-md-12">
                            <div class="row">
                                <label for="input-ticket-type" class="form-label">Ticket Type</label>
                                <input type="text" id="ticket-type-list-item" name="ticket-type-list-item" class="form-control">       
                            </div>
                            <div class="row">
                                <label for="input-ticket-price" class="form-label">Ticket Price</label>
                                <input type="text" id="ticket-price-list-item" name="ticket-price-list-item" class="form-control">              
                            </div>
                            <div class="row">
                                <label for="input-total-ticket" class="form-label">Total Ticket</label>
                                <input type="text" id="total-ticket-list-item" name="total-ticket-list-item" class="form-control">       
                            </div>
                            <div class="button-wrapper d-flex justify-content-center mt-4">
                                <button class="add-items add-button" id="add">ADD</button>
                            </div>
                        </div>
                    </div>
                    <!--Ticket Type Information input start-->

                    <!--Ticket Type Information table list start-->
                    <div class="row main-ticket-type-input">
                        <div class="col-md-12">
                            <table class="table" id="main-ticket-type-table">
                                <thead>
                                    <tr>
                                        <th>Ticket Type</th>
                                        <th>Price (RM)</th>
                                        <th>Total Ticket</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="js-psscroll ps ps--active-y" id="main-ticket-type-table-body">
                                    <tr>
                                        <td id="ticket-type-table-data" name=""></td>
                                        <td id="ticket-price-table-data" name=""></td>
                                        <td id="total-ticket-table-data" name=""></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--Ticket Type Information table list end-->
                </div>
            </div>
        </div>
    </div>
</div>



<!-- End of Page Content -->
@endsection