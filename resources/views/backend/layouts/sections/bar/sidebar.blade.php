<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion bg-gradient-primary-custom" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-ticket-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Concert Booking <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-calendar-week"></i>
            <span>Concert</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('admin/add_concert') }}" id="addConcertLink">Add Concert</a>
                <a class="collapse-item" href="{{ route('showConcert') }}" id="showConcertLink">Contert List</a>
                <!-- <a class="collapse-item" href="">Create Ticket Type</a>
                <a class="collapse-item" href="">Create Organizer</a> -->
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#">
            <i class="fas fa-list"></i>
            <span>Order List</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('showMembers') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('showMembers')}}" >
            <i class="fas fa-male"></i>
            <span>Member List</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Order</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Customer</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="{{ route('login.form') }}">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li> --}}
    <!-- Nav Item - Logout -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="confirmLogout(event)">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<!-- JavaScript for Logout Confirmation -->
<script>
    function confirmLogout(event) {
        if (confirm('Are you sure you want to logout?')) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
    }
</script>
<script>
    $(document).ready(function() {
        // Check if addConcert link is clicked
        if (window.location.href.includes("admin/add_concert")) {
            $('#collapseTwo').addClass('show'); // Add 'show' class to the dropdown element
            $('#collapseTwo').parent().addClass('active'); // Add 'active' class to the parent <li> element
            $('#addConcertLink').addClass('active'); // Add 'active' class to the addConcertLink
        }

        // Check if showConcert link is clicked
        if (window.location.href.includes("show_concert")) {
            $('#collapseTwo').addClass('show'); // Add 'show' class to the dropdown element
            $('#collapseTwo').parent().addClass('active'); // Add 'active' class to the parent <li> element
            $('#showConcertLink').addClass('active'); // Add 'active' class to the showConcertLink
        }
    });
</script>
<!-- End of Sidebar -->
