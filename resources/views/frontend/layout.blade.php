<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="/backend/assets/css/event_details.css" rel="stylesheet" />
    <link href="/backend/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Load jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include Toastr CSS and JS -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <!-- Include Toastr CSS and JS -->
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Navbar Area -->
        <div class="oneMusic-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="oneMusicNav">

                        <!-- Nav brand -->
                        <a href="index.html" class="nav-brand"><img src="img/core-img/logo.png" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav" >
                                <ul>
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    {{-- <li><a href="albums-store.html">Albums</a></li> --}}
                                    {{-- <li><a href="#">Pages</a>
                                        <ul class="dropdown">
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="albums-store.html">Albums</a></li>
                                            <li><a href="event.html">Events</a></li>
                                            <li><a href="blog.html">News</a></li>
                                            <li><a href="contact.html">Contact</a></li>
                                            <li><a href="elements.html">Elements</a></li>
                                            <li><a href="{{ route('login.form') }}">Login</a></li>
                                            <li><a href="#">Dropdown</a>
                                                <ul class="dropdown">
                                                    <li><a href="#">Even Dropdown</a></li>
                                                    <li><a href="#">Even Dropdown</a></li>
                                                    <li><a href="#">Even Dropdown</a></li>
                                                    <li><a href="#">Even Dropdown</a>
                                                        <ul class="dropdown">
                                                            <li><a href="#">Deeply Dropdown</a></li>
                                                            <li><a href="#">Deeply Dropdown</a></li>
                                                            <li><a href="#">Deeply Dropdown</a></li>
                                                            <li><a href="#">Deeply Dropdown</a></li>
                                                            <li><a href="#">Deeply Dropdown</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Even Dropdown</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li> --}}
                                    <li><a href="{{ url('/concert') }}">Events</a></li>
                                    {{-- <li><a href="blog.html">News</a></li> --}}
                                    <li><a href="{{ route('contact') }}">Contact</a></li>
                                    <!-- Add "Dashboard" link for admin users -->
                                    @auth
                                        @if (auth()->user()->isAdmin())
                                            <li><a href="{{ route('admin.dashboard') }}" target="_blank">Dashboard</a></li>
                                        @endif
                                    @endauth
                                </ul>


                                {{-- <!-- Search Bar -->
                                <div class="search-bar">
                                    <form action="{{ route('search.event') }}" method="GET">
                                        <input type="text" name="query" placeholder="Search concerts...">
                                        <button type="submit"><i class="fas fa-search"></i></button>
                                    </form>
                                </div> --}}
                                <!-- Login/Register & Button with Dropdown Profile -->
                                <div class="login-register-cart-button d-flex align-items-center">

                                    <form action="{{ route('search.event') }}" class="searchBox" method="GET">
                                        <input class="searchInput"type="text" name="query" placeholder="Search">
                                        <button class="searchButton" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>

                                    {{-- <form action="{{ route('search.event') }}" class="search-bar" method="GET">
                                        <input type="search" name="query" pattern=".*\S.*" required>
                                        <button class="search-btn" type="submit">
                                            <span>Search</span>
                                        </button>
                                    </form> --}}

                                    <!-- Cart Button -->
                                    @if (Auth::check())
                                        <a href="{{ route('MyCart') }}" class="cart-btn">
                                            <p><span class="icon-shopping-cart"></span> <span
                                                    class="quantity">{{ isset($cartCount) ? $cartCount : 0 }}</span>
                                            </p>
                                        </a>
                                    @else
                                        <a href="{{ url('/login/form') }}" class="cart-btn">
                                            <p><span class="icon-shopping-cart"></span> <span
                                                    class="quantity">{{ isset($cartCount) ? $cartCount : 0 }}</span>
                                            </p>
                                        </a>
                                    @endif
                                    <!-- Check if the user is authenticated -->
                                    @auth
                                        <!-- Display user's name and dropdown if authenticated -->
                                        <div class="dropdown">
                                            <a class="btn btn-link dropdown-toggle text-white" href="#"
                                                id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-user-circle" style="font-size: 24px;"></i>
                                                <span class="user-name"
                                                    style="font-weight: bold; font-size: 16px;">{{ Auth::user()->name }}</span>
                                            </a>
                                            <!-- Dropdown - User Information -->
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                                aria-labelledby="userDropdown">
                                                <a href="{{ route('show.userDashboard') }}" class="dropdown-item">
                                                    Ticket History
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ url('/logout') }}" id="logout-link"
                                                    onclick="confirmLogout(event)">
                                                    Logout
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Display login/register link if not authenticated -->
                                        <div class="login-register-btn mr-50">
                                            <a href="{{ route('login.form') }}" id="loginBtn" style="margin-left: 5px;">
                                            Login / Register</a>
                                        </div>
                                    @endauth

                                </div>

                            </div>
                        </div>
                        <!-- Nav End -->

                </div>
                </nav>
            </div>
        </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!--Content -->
    @yield('content')

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container">
            <div class="row d-flex flex-wrap align-items-center">
                <div class="col-12 col-md-6">
                    <a href="#"><img src="img/core-img/logo.png" alt=""></a>
                    <p class="copywrite-text"><a
                            href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> Company. All rights reserved | Crafted with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank">Group 8</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>

                <div class="col-12 col-md-6">
                    <div class="footer-nav">
                        <ul>
                            <!-- <li><a href="#">Home</a></li>
                            <li><a href="#">Albums</a></li>
                            <li><a href="#">Events</a></li>
                            <li><a href="#">News</a></li>
                            <li><a href="#">Contact</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- JavaScript for Logout Confirmation -->
    {{-- <script>
        function confirmLogout(event) {
            if (confirm('Are you sure you want to logout?')) {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            }
        }
    </script> --}}

    <script>
        function confirmLogout(event) {
            event.preventDefault(); // Prevent the default behavior of the link

            // Show a confirmation dialog
            var confirmation = confirm("Are you sure you want to log out?");

            // If the user confirms, proceed with the logout
            if (confirmation) {
                window.location.href = document.getElementById('logout-link').href;
            } else {
                // If the user cancels, do nothing or perform any other desired action
                console.log("Logout cancelled");
            }
        }
    </script>

    <!-- ##### All Javascript Script ##### -->
    <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <!-- All Plugins js -->
    <script src="{{ asset('js/plugins/plugins.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('js/active.js') }}"></script>
</body>

</html>
