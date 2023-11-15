@extends('backend/layouts/commonMaster')
@section('layoutContent')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Event</h1>
    </div>

    <form action="" method="post" enctype='multipart/form-data' >
    @csrf

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters ">
                         <!--img-upload-session start-->
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
                            <!--thumb-img-upload start-->
                            <div class="row d-flex justify-content-around">
                                <div class="thumb-upload-set colo-md-12">
                                    <div class="thumb-img-upload card">
                                        <div class="thumb-img-preview">
                                            <img src="{{asset('backend/assets/img/upload.jpg')}}" alt="edit-image">
                                        </div>
                                        <div class="thumb-img-edit">
                                            <input type="file" id="imageUpload" class="" accept=".png, .jpg, .jpeg">
                                        </div>
                                    </div>
                                    <div class="thumb-img-upload card">
                                        <div class="thumb-img-preview">
                                            <img src="{{asset('backend/assets/img/upload.jpg')}}" alt="edit-image">
                                        </div>
                                        <div class="thumb-img-edit">
                                            <input type="file" id="imageUpload" class="" accept=".png, .jpg, .jpeg">
                                        </div>
                                    </div>
                                    <div class="thumb-img-upload card">
                                        <div class="thumb-img-preview">
                                            <img src="{{asset('backend/assets/img/upload.jpg')}}" alt="edit-image">
                                        </div>
                                        <div class="thumb-img-edit">
                                            <input type="file" id="imageUpload" class="" accept=".png, .jpg, .jpeg">
                                        </div>
                                    </div>
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
                             <!--thumb-img-upload end-->
                        </div>
                        <!--img-upload-section end-->
                        <!--concert-information-section start-->
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="concert-upload-detail">
                                <form class="column">
                                    <div><h2 class="card-title ml-2">Concert Details</h2></div>
                                    <div class="col-md-12">
                                        <label for="input-concert-name" class="form-label">Concert name</label>
                                        <input type="text" class="form-control slug-title" id="input-concert-name" name="input-concert-name">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="input-concert-organiser-id" class="form-label">Organiser</label>
                                        <select name="input-concert-organiser-id" id="input-concert-organiser-id" class="form-control"></select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="w3review">Concert Venue</label>
                                        <textarea id="input-concert-venue" rows="4" cols="50" name="input-concert-venue"></textarea>
                        
                                    </div>
                                </form>
                            </div>
                        </div>
                         <!--concert-information-section end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

<!--</div>-->

<!-- /.container-fluid -->

<!-- </div> -->
<!-- End of Page Content -->
@endsection