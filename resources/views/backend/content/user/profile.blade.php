<head>
    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fbc2eb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1))
        }

    </style>
    <link href="/backend/assets/css/button.css" rel="stylesheet" />

</head>
@extends('backend/layouts/commonMaster')
@section('layoutContent')
<section class=" gradient-custom-2">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col col-lg-9 col-xl-7">
                <div class="card">
                    <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                        <div class="ml-4 mt-5 d-flex flex-column" style="width: 150px;">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                                style="width: 150px; z-index: 1">
                            <button type="button" class="button-59 rounded" data-mdb-ripple-color="dark"
                                style="z-index: 1;width: 150px;">
                                Edit profile
                            </button>
                        </div>
                        <div class="ml-4" style="margin-top: 130px;">
                            <h5>Andy Horwitz</h5>
                            <p>New York</p>
                        </div>
                    </div>
                    <div class="p-4 text-black" style="background-color: #f8f9fa;">
                        <div class="d-flex justify-content-end text-center py-1">
                             <div>
                                <p class="mb-1 h5">478</p>
                                <p class="small text-muted mb-0">Transactions</p>
                            </div>
                            <div class="px-3">
                                <p class="mb-1 h5">1026</p>
                                <p class="small text-muted mb-0">Tickets</p>
                            </div> 
                            
                        </div>
                    </div>
                    <div class="card-body p-4 text-black">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="mb-4">Profile Details</h5>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">example@example.com</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">(097) 234-5678</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Register Date</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">18 June 2023</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection