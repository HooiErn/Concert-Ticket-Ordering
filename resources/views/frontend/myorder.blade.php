<head>
    <script>
        $(function () {
            $(".dropdown-menu").on('click', 'a', function () {
                $(this).parents('.dropdown').find('button').text($(this).text());
            });
        });
    </script>
    <link href="/backend/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
@extends('backend/layouts/commonMaster')
@section('layoutContent')
<div class="container-fluid">
    <div class="row p-2">
        <h3 class="ml-2">My Concert Order</h6>

        <div class="card shadow mb-4" style="width:100%">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="concert-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User Name</th>
                                    <th>Concert Name</th>
                                    <th>User Email</th>
                                    <th>Total Amount</th>
                                    <th>Payment_Status</th>
                                    <th>Booking Date</th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->user_name}}</td>
                                    <td>{{$order->concert_name}}</td>
                                    <td>{{$order->user_email}}</td>
                                    <td>{{$order->total_amount}}</td>
                                    <td>{{$order->payment_status}}</td>
                                    <td>{{$order->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <!-- <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Details
                                    </button> -->
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                    href="{{route('vieworder',['id'=>$order->id])}}"><i
                                                        class="bi bi-eye mr-2"></i>View Details</a>
                                                {{-- <a class="dropdown-item"
                                                    href="{{route('editConcert',['id'=>$concert->id])}}"><i
                                                        class="bi bi-pencil-square mr-2"></i>Edit</a>
                                                <a class="dropdown-item"
                                                    href="{{route('deleteConcert',['id'=>$concert->id])}}"
                                                    class="btn btn-danger btn-xs"
                                                    onClick="return confirm('Are you sure to delete this concert?')"><i
                                                        class="bi bi-trash mr-2"></i>Delete</a> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <!-- <td>
                                <button class="btn">Button</button>
                                <div class="dropdown">
                                    <button class="btn" style="border-left:1px solid navy">
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-content">
                                        <a href="#">Link 1</a>
                                        <a href="#">Link 2</a>
                                        <a href="#">Link 3</a>
                                    </div>
                                </div>
                            </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Ticket Type Information table list end-->
@endsection
