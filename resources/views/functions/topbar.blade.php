<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebar_bar" class="btn btn-link" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link" href="#" id="userDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 text-gray-600 small">{{Auth::user()->name}}</span>
                <img class="img-profile rounded-circle" src="{{ asset('images/undraw_profile.svg')}}">
            </a>
        </li>
    </ul>
</nav>

<!-- ... Your sidebar HTML ... -->

<script>
    function toggleSidebar() {
        var sidebar = document.getElementById("mySidebar");
        var container = document.getElementById("content");
        var sidebarBar = document.getElementById("sidebar_bar");

        if (sidebar.style.display === "none") {
            // Open the sidebar
            var sidebarWidth = window.innerWidth >= 768 ? '15%' : '50%';
            container.style.marginLeft = sidebarWidth;
            sidebar.style.width = sidebarWidth;
            sidebar.style.display = "block";
            sidebarBar.innerHTML = '<i class="fas fa-times"></i>';
        } else {
            // Close the sidebar
            container.style.marginLeft = "0%";
            sidebar.style.display = "none";
            sidebarBar.innerHTML = '<i class="fas fa-bars"></i>';
        }
    }
</script>