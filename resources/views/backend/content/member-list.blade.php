<head>
    <script>
        $(function () {
            $(".dropdown-menu").on('click', 'a', function () {
                $(this).parents('.dropdown').find('button').text($(this).text());
            });
        });
    </script>
    <link href="/backend/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <head>Member List</head>
</head>
@extends('backend/layouts/commonMaster')
@section('layoutContent')
<div class="container-fluid">
    <div class="row p-2">
        <h3 class="ml-2">All Members</h6>

            <div class="card shadow mb-4" style="width:100%">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="user-table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Role</th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->contact_number}}</td>
                                        @if($user->role =='1')
                                        <td class="text-primary"> Admin </td>
                                        @else
                                        <td style="color:green"> User </td>
                                        @endif


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
                                                    <a class="dropdown-item" href="#"><i class="bi bi-eye mr-2"></i>View Details</a>    
                                                    <a class="dropdown-item" href="{{ route('deleteUser', ['id' => $user->id]) }}"
                                                    class="btn btn-danger btn-xs" onClick="return confirm('Are you sure to delete this user?')">
                                                        <i class="bi bi-trash mr-2"></i>Delete
                                                    </a>
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