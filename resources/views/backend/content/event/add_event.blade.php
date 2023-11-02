@extends('backend/layouts/commonMaster')
@section('layoutContent')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Event</h1>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-lg-4 col-md-4 col-sm-12 event-img-upload">
                            <div class="row d-flex justify-content-center">
                                <div class="img-upload card">
                                    <div class="img-preview">
                                        <img src="{{asset('backend/assets/img/upload.jpg')}}" alt="edit-image">
                                    </div>
                                    <div class="img-edit">
                                        <input type="file" id="imageUpload" class="" accept=".png, .jpg, .jpeg">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-4 col-sm-6">
                                    <div class="thumb-img-upload card">
                                        <div class="thumb-img-preview">
                                            <img src="{{asset('backend/assets/img/upload.jpg')}}" alt="edit-image">
                                        </div>
                                        <div class="thumb-img-edit">
                                            <input type="file" id="imageUpload" class="" accept=".png, .jpg, .jpeg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="thumb-img-upload card">
                                        <div class="thumb-img-preview">
                                            <img src="{{asset('backend/assets/img/upload.jpg')}}" alt="edit-image">
                                        </div>
                                        <div class="thumb-img-edit">
                                            <input type="file" id="imageUpload" class="" accept=".png, .jpg, .jpeg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!--</div>-->

<!-- /.container-fluid -->

<!-- </div> -->
<!-- End of Page Content -->
@endsection