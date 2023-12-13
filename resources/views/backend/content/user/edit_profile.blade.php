<head>
    <link href="/backend/assets/css/button.css" rel="stylesheet" />
</head>
@extends('backend/layouts/commonMaster')
@section('layoutContent')
<div class="container-fluid">
    <div class="row">
        <div class="card shadow">
            <!-- Page title -->
            <div class="card-header">
                <h5 class="ml-4 mt-1 font-weight-bold text-primary">Edit Profile</h5>
            </div>
            <form class="file-upload">
                <div class="row p-2">
                    <!-- Upload profile -->
                    <div class="col-md-4 px-4 py-3 d-flex justify-content-center">
                        <div class="text-center">
                            <!-- Image upload -->
                            <div class="img-upload card mb-3">
                                <div class="img-preview">
                                    <img src="{{asset('backend/assets/img/upload.jpg')}}" alt="edit-image" id="img1">
                                </div>
                            </div>
                            <!-- Button -->
                            <input type="file" id="customFile" name="file" hidden="">
                            <label class="button-58" for="customFile">Upload</label>
                            <button type="button" class="button-58"  style="background-color:red; border-color:red;" onmouseover="this.style.backgroundColor='#FF3131'" onmouseout="this.style.backgroundColor='red'">Remove</button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="bg-secondary-soft px-4 py-3 rounded">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <h5 class="mb-4 mt-0">Contact detail</h5>
                                </div>
                                <!-- First Name -->
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="Scarlet" aria-label="First name"
                                        value="" disabled>
                                </div>
                                <!-- Phone number -->
                                <div class="col-md-6">
                                    <label class="form-label">Phone number *</label>
                                    <input type="text" class="form-control" placeholder="(333) 000 555" aria-label="Phone number"
                                        value="">
                                </div>
                                <!-- Email -->
                                <div class="col-md-12 mt-3">
                                    <label for="inputEmail4" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="inputEmail4"
                                        value="" placeholder="example@homerealty.com">
                                </div>
                            </div> <!-- Row END -->
                        </div>
                    </div>


                </div>
                <!-- button -->
                <div class="gap-3 d-md-flex justify-content-center text-center">
                    <button type="button" class="button-59 p-4">Update profile</button>
                </div>
            </form> <!-- Form END -->
        </div>
    </div>
</div>

@endsection