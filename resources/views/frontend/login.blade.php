@extends('frontend/layout')
@section('title', 'Login/Register')
@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title -->
        <title>Login</title>

        <!-- Favicon -->
        <link rel="icon" href="img/core-img/favicon.ico">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    </head>

    <body>

        <!-- ##### Login Area Start ##### -->
        <section class="login-area section-padding-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="login-content">

                            <!-- Nav Tabs -->
                            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login"
                                        role="tab" aria-controls="login" aria-selected="true">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab"
                                        aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content" id="myTabsContent">

                                <!-- Login Form -->
                                <div class="tab-pane fade show active" id="login" role="tabpanel"
                                    aria-labelledby="login-tab">
                                    <h3>Welcome Back</h3>
                                    <form action="{{ route('check.login') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email"
                                                aria-describedby="emailHelp" placeholder="Enter E-mail" name="email">
                                            <small id="emailHelp" class="form-text text-muted">
                                                <i class="fa fa-lock mr-2"></i>We'll never share your email with anyone
                                                else.
                                            </small>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password"
                                                placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" name="rememberme" id="rememberme"
                                                @if (Cookie::has('name')) checked @endif>
                                            <span>Remember Me</span>
                                        </div>
                                        <div class="form-group">
                                            <a class="small forgot-password" href="{{ route('password.request') }}">Forgot
                                                your password?</a>
                                        </div>
                                        <button type="submit" class="btn oneMusic-btn mt-30">Login</button>
                                    </form>
                                </div>

                                <!-- Register Form -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <h3>Create your Account</h3>
                                    <form action="{{ route('user.register') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="registerName">Full Name</label>
                                            <input type="text" class="form-control" id="registerName"
                                                placeholder="Enter your full name" name="m_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="registerEmail">Email address</label>
                                            <input type="email" class="form-control" id="registerEmail"
                                                placeholder="Enter your email" name="m_email">
                                        </div>
                                        <div class="form-group">
                                            <label for="registerPassword">Password</label>
                                            <input type="password" class="form-control" id="registerPassword"
                                                placeholder="Choose a password" name="m_password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmPassword">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirmPassword"
                                                placeholder="Confirm your password" name="m_confirm_password">
                                                <small id="PasswordHelp" class="form-text text-muted">
                                                    <i class="fa fa-key mr-2"></i>Password must be between 8 and 12 characters.
                                                </small>
                                        </div>
                                        <div class="form-group">
                                            <label for="contactNumber">Contact Number</label>
                                            <input type="text" class="form-control" id="contactNumber"
                                                placeholder="Enter your contact number" name="m_contact_number">
                                        </div>
                                        <button type="submit" class="btn oneMusic-btn mt-15">Sign Up</button>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ##### Login Area End ##### -->


        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!-- Bootstrap js -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- All Plugins js -->
        <script src="{{ asset('js/plugins/plugins.js') }}"></script>
        <!-- Active js -->
        <script src="{{ asset('js/active.js') }}"></script>

        <!-- Activate Bootstrap Tabs -->
        <script>
            $(document).ready(function() {
                $('#myTabs a').on('click', function(e) {
                    e.preventDefault();
                    $(this).tab('show');
                });
            });
        </script>

    </body>

    </html>
@endsection
