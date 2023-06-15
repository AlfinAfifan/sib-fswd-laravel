<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route(Auth::user()->role->name == 'admin'? 'dashboard' : 'product.index')  }}">
        <div class="sidebar-brand-icon">
            <i class="bi bi-clipboard-data-fill"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Data </div>
    </a>


    @if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'staff')
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('landing.index') }}">
                <i class="bi bi-house-door-fill"></i>
                <span>Landing Page</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('slider*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('slider.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Slider</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Management
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ Request::is('product*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="bi bi-briefcase-fill"></i>
                <span>Manage Product</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('product.index') }}">List Product</a>
                    <a class="collapse-item" href="{{ route('category.index') }}">Category</a>
                    <a class="collapse-item" href="{{ route('brand.index') }}">Brand</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item {{ Request::is('user*') ? 'active' : '' }}">
            <a class="nav-link collapsed {{ Request::is('user/*') ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Manage User</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('user.index') }}">List User</a>
                    <a class="collapse-item" href="{{ route('role.index') }}">Role</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endif

    {{-- Product User --}}
    @if (Auth::user()->role->name == 'user')
        <div class="sidebar-heading">
            Management
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.index') }}">
                <i class="bi bi-briefcase-fill"></i>
            <span>Product</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
