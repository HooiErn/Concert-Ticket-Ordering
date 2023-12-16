<head>
    <title>Add Concert</title>
    <script>
        function handleImgUpload(event, previewId) {
            let imgFile = event.target.files[0];
            let imgPreview = document.getElementById(previewId);

            let reader = new FileReader();
            reader.onload = function (e) {
                imgPreview.src = e.target.result;
            };

            reader.readAsDataURL(imgFile);
        }
    </script>
     <link href="/backend/assets/css/button.css" rel="stylesheet" />
</head>
@extends('backend/layouts/commonMaster')
@section('layoutContent')
<!-- Begin Page Content -->
<form action="{{route('addConcert')}}" method="post" enctype='multipart/form-data'>
    @csrf
    <!-- Begin concert information -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Concert</h1>
        </div>
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
                                            <img src="{{asset('backend/assets/img/upload.jpg')}}" alt="edit-image"
                                                id="img1">
                                        </div>
                                        <div class="img-edit">
                                            <input type="file" id="imageUpload" class="" name="concert_images[]"
                                                accept=".png, .jpg, .jpeg" onchange="handleImgUpload(event, 'img1')">
                                        </div>
                                    </div>
                                </div>
                                <!--thumb-img-upload start-->
                                <div class="row d-flex justify-content-around">
                                    <div class="thumb-upload-set colo-md-12">
                                        <div class="thumb-img-upload card">
                                            <div class="thumb-img-preview">
                                                <img src="{{asset('backend/assets/img/upload.jpg')}}" alt="edit-image"
                                                    id="img2">
                                            </div>
                                            <div class="thumb-img-edit">
                                                <input type="file" id="imageUpload" name="concert_images[]" class=""
                                                    accept=".png, .jpg, .jpeg"
                                                    onchange="handleImgUpload(event, 'img2')">
                                            </div>
                                        </div>
                                        <div class="thumb-img-upload card">
                                            <div class="thumb-img-preview">
                                                <img src="{{asset('backend/assets/img/upload.jpg')}}" alt="edit-image"
                                                    id="img3">
                                            </div>
                                            <div class="thumb-img-edit">
                                                <input type="file" id="imageUpload" name="concert_images[]" class=""
                                                    accept=".png, .jpg, .jpeg"
                                                    onchange="handleImgUpload(event, 'img3')">
                                            </div>
                                        </div>
                                        <div class="thumb-img-upload card">
                                            <div class="thumb-img-preview">
                                                <img src="{{asset('backend/assets/img/upload.jpg')}}" alt="edit-image"
                                                    id="img4">
                                            </div>
                                            <div class="thumb-img-edit">
                                                <input type="file" id="imageUpload" name="concert_images[]" class=""
                                                    accept=".png, .jpg, .jpeg"
                                                    onchange="handleImgUpload(event, 'img4')">
                                            </div>
                                        </div>
                                        <div class="thumb-img-upload card">
                                            <div class="thumb-img-preview">
                                                <img src="{{asset('backend/assets/img/upload.jpg')}}" alt="edit-image"
                                                    id="img5">
                                            </div>
                                            <div class="thumb-img-edit">
                                                <input type="file" id="imageUpload" name="concert_images[]" class=""
                                                    accept=".png, .jpg, .jpeg"
                                                    onchange="handleImgUpload(event, 'img5')">
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
                                    <div>
                                        <h2 class="card-title ml-2">Concert Details</h2>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="concert-name" class="form-label">Concert name</label>
                                        <input type="text" class="form-control slug-title" id="concert-name"
                                            name="concert-name">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="concert-organizer" class="form-label">Organiser</label>
                                        <input type="text" class="form-control slug-title" id="concert-organizer"
                                            name="concert-organizer">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="concert-datetime" class="form-label">Concert
                                            DateTime</label>
                                        <input type="datetime-local" class="form-control slug-title"
                                            id="concert-datetime" name="concert-datetime">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="w3review">Concert Venue</label>
                                        <textarea id="concert-venue" rows="3" cols="50" name="concert-venue"></textarea>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="w3review">Concert Description</label>
                                        <textarea id="concert-description" rows="5" cols="50"
                                            name="concert-description"></textarea>
                                    </div>

                                </div>
                            </div>
                            <!--concert-information-section end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End concert information -->

    <!-- Begin ticket type information -->
    <div class="container-fluid mb-4">
        <!-- Page Heading -->
        <div class="d-sm-flex mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Ticket Price</h1>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="price-VIP" class="form-label">VIP (RM)</label>
                                <input type="number" class="form-control slug-title" id="price-VIP" name="price-VIP"
                                    min="0.00">
                            </div>
                            <div class="col-md-3">
                                <label for="price-CAT1" class="form-label">CAT 1 (RM)</label>
                                <input type="number" class="form-control slug-title" id="price-CAT1" name="price-CAT1"
                                    min="0.00">
                            </div>
                            <div class="col-md-3">
                                <label for="price-CAT2" class="form-label">CAT 2 (RM)</label>
                                <input type="number" class="form-control slug-title" id="price-CAT2" name="price-CAT2"
                                    min="0.00">
                            </div>
                            <div class="col-md-3">
                                <label for="price-CAT3" class="form-label">CAT 3 (RM)</label>
                                <input type="number" class="form-control slug-title" id="price-CAT3" name="price-CAT3"
                                    min="0.00">
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End ticket type information -->
    <div class="container-fluid d-flex justify-content-center ">
        <button type="submit" class="button-18 mb-4" style="padding: 12px 30px;!important">Add</button>
    </div>
</form>


<!-- End of Page Content -->
@endsection