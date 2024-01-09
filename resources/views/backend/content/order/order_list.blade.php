<head>
 <!-- Custom styles for this page -->
 <link href="/backend/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
@extends('backend/layouts/commonMaster')
@section('layoutContent')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order History</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Concert Name</th>
                            <th>Total Ticket</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>

                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->concert_name }}</td>
                            <td>
                                @foreach($order->items as $item)
                                    {{ $item->seat_quantity }} <br>
                                @endforeach
                            </td>
                            <td>{{ $order->date_time }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{{ $order->payment_status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection