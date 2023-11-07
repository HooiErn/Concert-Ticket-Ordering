<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="backend/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="backend/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="backend/assets/css/custom.css" rel="stylesheet">

    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    </head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            @include('backend/layouts/sections/bar/sidebar')
                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">
                    <!-- Main Content -->
                    <div id="content">
                        @include('backend/layouts/sections/bar/topbar')
                        @yield('layoutContent')
                    </div>
                    <!-- End of Main Content -->
                    @include('backend/layouts/sections/footer/footer')
                </div>
                <!-- End of Content Wrapper -->
            
        </div>
        <!-- End of Page Wrapper -->
        @include('backend/layouts/sections/button/scroll_to_top_button')
        @include('backend/layouts/sections/modal/logout_modal')
        @include('backend/layouts/script_included')
    </body>
</html>
