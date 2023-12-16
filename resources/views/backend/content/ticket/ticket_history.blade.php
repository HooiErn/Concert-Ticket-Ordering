@extends('backend/layouts/commonMaster')
@section('layoutContent')
<div class="container-fluid">
    <div class="row">
        <h3 class="ml-3">Ticket History</h3>
        <div class="card shadow mb-4 ticket-type-info m-3 rounded" style="width:100%">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 p-3 mt-1">
                        <div class="col-md-12 mb-4 text-justify">
                            <h6 class="m-0 font-weight-bold text-primary">New Year's Concert 2024 "Timeless Pop,
                                Rock &
                                Broadway"
                                by the Selangor Symphony Orchestra</h6>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="h6 mb-0 text-gray-800"><i class="bi bi-calendar-event mr-2"></i>18 June 2024
                                18:00</div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="h6 mb-0 text-gray-800 text-justify"><i class="bi bi-geo-alt mr-1"></i> Menara
                                KEN TTDI
                                The Platfrom @ Menara KEN TTDI, 37, Jalan Burhanuddin Helmi, Taman Tun Dr Ismail, 60000
                                Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur, Malaysia</div>
                        </div>
                        <div class="col-md-12">
                            <div class="h6 mb-0 text-gray-800 font-weight-bold"><i
                                    class="bi bi-ticket-perforated mr-2"></i> VIP - V001, VIP - V002, CAT1 - C100, CAT2
                                - C200
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 p-2">
                        <div class="col-md-12 text-center">
                            <span class="mr-2">Ticket ID: #0618</span>
                            <div class=""><img style="width: 180px; height=180px"
                                    src="https://th.bing.com/th/id/OIP.O1dUKkJZGyfVs6mqtnKCiAAAAA?w=330&h=330&rs=1&pid=ImgDetMain" />
                            </div>
                            <a href="#" class="btn btn-primary">View Ticket
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection