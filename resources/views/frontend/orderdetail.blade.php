<head>
    <script>
        $(function() {
            $(".dropdown-menu").on('click', 'a', function() {
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
                                            <th>Concert Name</th>
                                            <th>Seat Quantity</th>
                                            <th>Seat Number</th>
                                            <th>Total Price</th>
                                            <th>Booking Date</th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orderItems as $orderItem)
                                            <tr>
                                                <td>{{ $orderItem->id }}</td>
                                                <td>{{ $orderItem->concert_name }}</td>
                                                <td>{{ $orderItem->seat_quantity }}</td>
                                                <td>{{ $orderItem->seat_number }}</td>
                                                <td>{{ $orderItem->total_price }}</td>
                                                <td>{{ $orderItem->created_at->format('d-m-Y') }}</td>
                                                <td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">No items found for this order.</td>
                                            </tr>
                                        @endforelse
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
