@extends('backend/layouts/commonMaster')
@section('layoutContent')
<div class="container-fluid">
    <div class="row">
        <div class="card shadow mb-4 ticket-type-info m-3" style="width:100%">
            <div class="card-header py-3">
                <div class="row d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary ml-3">Ticket Information</h6>
                    <span class="mr-2">Ticket ID: #0618</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 p-2">
                        <div class="col-md-12 mb-4">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Event</div>
                            <div class="h6 mb-0 text-gray-800">New Year's Concert 2024 "Timeless Pop, Rock & Broadway"
                                by the Selangor Symphony Orchestra</div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Organiser</div>
                            <div class="h6 mb-0 text-gray-800">Selangor Symphony Orchestra</div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Date</div>
                            <div class="h6 mb-0 text-gray-800">18 June 2024 18:00</div>

                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Venue</div>
                            <div class="h6 mb-0 text-gray-800">Menara KEN TTDI
                                The Platfrom @ Menara KEN TTDI, 37, Jalan Burhanuddin Helmi, Taman Tun Dr Ismail, 60000
                                Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur, Malaysia</div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 mb-4">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Total Ticket
                                    </div>
                                    <div class="h6 mb-0 text-gray-800">4</div>
                                </div>
                                <div class="col-md-9 mb-4">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Seat</div>
                                    <div class="h6 mb-0 text-gray-800">VIP - V001, VIP - V002, CAT1 - C100, CAT2 - C200
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="col-md-12 mb-4 text-center col-sm-12">
                            <div class="img-fluid"><img style="max-width: 200px; max-height:200px"
                                    src="https://th.bing.com/th/id/OIP.O1dUKkJZGyfVs6mqtnKCiAAAAA?w=330&h=330&rs=1&pid=ImgDetMain" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-2 mt-4">
                    <div class="col-md-12">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Terms & Conditions</div>
                        <div class="text-sm mb-0 text-gray-500" style="font-size: 0.8rem">
                            1. Each ticket includes admission for one (01) person and is applicable across all ages,
                            including children and infants.
                            <br />2. Tickets are on a first-come, first-served basis and are subject to availability.
                            <br />3. Tickets sold are NOT refundable or exchangeable.
                            <br />4. The Organiser shall not be liable and responsible for any loss or damage to the
                            tickets sold.
                            <br />5. The resale of tickets at the same or any price in excess of the initial purchase
                            price
                            is prohibited.
                            <br />6. Strictly no video recording and photography allowed during the show.
                            <br />7. Video cameras, cameras and tablet computers such as iPads are not allowed in the
                            venue.
                            <br />8. Lost or damaged ticket(s) will not be entertained.
                            <br />9. Other terms and conditions apply.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection