<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('dselect')">
        <a class="nav-link" href="{{ url('dashb') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item @yield('cselect')">
        <a class="nav-link" href="{{ url('cat') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Categories</span>
        </a>
    </li>
    <hr class="sidebar-divider">

    <li class="nav-item @yield('tselect')">
        <a class="nav-link" href="{{ url('tags') }}">
            <i class="fas fa-tags"></i>
            <span>tags</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item @yield('bselect')">
        <a class="nav-link" href="{{ url('blogs') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>blogs</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item @yield('aselect')">
        <a class="nav-link" href="{{ url('await') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Awaiting Approval</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->