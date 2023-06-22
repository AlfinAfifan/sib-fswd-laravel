<nav class="navbar navbar-expand-lg bg-white topbar sticky-top shadow">
    <div class="container">

        <a href="{{ route('landing.index') }}" class="text-black text-decoration-none navbar-brand"><img src="{{ asset('img/logo.png') }}" alt="logo" style="max-width: 100px;"></a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 fw-medium">
            <li class="nav-item mx-2"><a class="nav-link active text-black" aria-current="page" href="{{ route('landing.index') }}">Home</a></li>
            <li class="nav-item dropdown mx-2">
                <a class="nav-link text-black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Category<i class="bi bi-caret-down-fill mt-1" style="scale: 0.8;"></i>
                </a>
                <ul class="dropdown-menu">
                    @foreach ($categories as $category)
                    <li><a class="dropdown-item" href="{{ route('landing.index', ['category' => $category->name]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="nav-item mx-2"><a class="nav-link active text-black" aria-current="page" href="#footer">About Us</a></li>
        </ul>



        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item my-auto">
                <!-- Topbar Search -->
                <form action="{{ route('landing.index') }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control bg-light small border-black" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2" name="search">
                        <div class="input-group-append">
                            <button class="btn btn-dark btn-outline-black" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </li>

            <!-- Nav Item - Chart -->
            <li class="nav-item dropdown no-arrow mx-3 my-auto">
                <a class="btn btn-outline-dark" href="{{ route('cart.index') }}">
                    <i class="bi-cart-fill me-1"></i>Cart
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $totalCart }}</span>
                </a>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            @auth()
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::user()->avatar)
                    <img class="img-profile rounded-circle" src="{{ asset('storage/user/'. Auth::user()->avatar) }}">
                    @else
                    <img class="img-profile rounded-circle" src="{{ asset('img/profil.jpg') }}" alt="no-profil">
                    @endif
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('landing.profile', Auth::user()->id) }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    @if (Auth::user()->role->name == 'admin')
                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Dashboard
                    </a>
                    @endif
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout
                    </a>
                </div>
            </li>
        </ul>
        @endauth

        @guest
        <a href="{{ route('login') }}" class="btn ms-1 btn-outline-dark">
            <i class="bi-person-fill me-1"></i>
            Login
        </a>
        @endguest
    </div>
</nav>

<!-- Logout Modal-->
<div class="modal fade logout" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
