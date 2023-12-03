<head>
    <script>
        $(function () {
            $(".dropdown-menu").on('click', 'a', function () {
                $(this).parents('.dropdown').find('button').text($(this).text());
            });
        });
    </script>
</head>
@extends('backend/layouts/commonMaster')
@section('layoutContent')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Concert</th>
                            <th>Organiser</th>
                            <th>Venue</th>
                            <th>View DateTime</th>
                            <th>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Active
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Edit</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Ticket Type Information table list end-->
@endsection