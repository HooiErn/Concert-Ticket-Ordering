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
<form action="{{route('updateConcert')}}" method="post" enctype='multipart/form-data'>
    @csrf
    <!-- Begin concert information -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Concert</h1>
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
                                            @if(count($concertImages)>0)
                                            <img src="{{ asset('images/' . $concertImages[0]) }}" alt="edit-image"
                                                id="img1">
                                            @else
                                            <img src="empty.jpg" alt="Empty Image">
                                            @endif
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
                                        <!-- get the elements of the $concertImages array from index 1 to the end -->
                                        @foreach(array_slice($concertImages, 1) as $index => $image)
                                        <div class="thumb-img-upload card">
                                            <div class="thumb-img-preview">
                                                <img src="{{ asset('images/' . $image) }}"
                                                    alt="Concert Image {{$index+2}}" id="img {{$index+2}}">
                                                <!-- <input type="hidden" value="{{ asset('images/' . $image) }}" name="concert_images[]"> -->
                                                <input type="hidden" value="{{$index+2}}" name="image_ids[]">
                                            </div>
                                            <div class="thumb-img-edit">
                                                <input type="file" id="imageUpload" name="concert_images[]" class=""
                                                    accept=".png, .jpg, .jpeg"
                                                    onchange="handleImgUpload(event, 'img {{$index+2}}')">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--thumb-img-upload end-->

                            <!--img-upload-section end-->
                            <!--concert-information-section start-->
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="concert-upload-detail">
                                    <div>
                                        <h2 class="card-title ml-2">Concert Details</h2>
                                    </div>

                                    <div class="col-md-12">
                                        <input type="text" id="concert-id" name="concert-id" value="{{$concerts->id}}"
                                            hidden>
                                        <label for="concert-name" class="form-label">Concert name</label>
                                        <input type="text" class="form-control slug-title" id="concert-name"
                                            name="concert-name" value="{{$concerts->name}}">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="concert-organizer" class="form-label">Organiser</label>
                                        <input type="text" class="form-control slug-title" id="concert-organizer"
                                            name="concert-organizer" value="{{$concerts->organizer_name}}">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="concert-datetime" class="form-label">Concert
                                            DateTime</label>
                                        <input type="datetime-local" class="form-control slug-title"
                                            id="concert-datetime" name="concert-datetime"
                                            value="{{$concerts->date_time}}">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="w3review">Concert Venue</label>
                                        <textarea id="concert-venue" rows="3" cols="50" name="concert-venue"
                                            value="">{{$concerts->venue}}</textarea>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="w3review">Concert Description</label>
                                        <textarea id="concert-description" rows="5" cols="50"
                                            name="concert-description">{{$concerts->description}}</textarea>
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
            <h1 class="h3 mb-0 text-gray-800">Edit Ticket Price</h1>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row">
                            @foreach($ticketType as $ticket)
                            <div class="col-md-3">
                                <label for="price-VIP" class="form-label">{{ $ticket['name'] }} (RM)</label>
                                <input type="number" class="form-control slug-title" id="price-{{ $ticket['name'] }}"
                                    name="price-{{ $ticket['name'] }}" min="0.00" value="{{ $ticket['price'] }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- End ticket type information -->
    <div class="container-fluid d-flex justify-content-center ">
        <button type="submit" class="button-18 mb-4" style="padding: 12px 30px;!important">Update</button>
    </div>
</form>
@endsection