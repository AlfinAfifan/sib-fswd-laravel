<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Undangan Trenggalek</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/style-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    {{-- Google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- Navigation-->
    @include('partials.navbar-landing')

    {{-- content --}}
    @yield('content')

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container ">
            <div class="row">
                <div class="col-md-4 ps-5">
                    <p class="m-0 text-white"><strong> Hari Buka : </strong><br/> Senin - Sabtu, 08.00 - 16.00
                    </p>
                    <p class="m-0 text-white"><strong> Alamat Toko : </strong><br/>Jl. Gandusari-Kedunglurah Km.05 <br/> Kab. Trenggalek 66372
                    </p>
                </div>
                <div class="col-md-4 ps-5">
                    <p class="m-0 text-white"><strong> Contact Us : </strong></p>
                    <p class="m-0 text-white">Telp/WA : 0852-5988-3122</p>
                    <p class="m-0 text-white">Email: melisgrafis@gmail.com</p>
                    <p class="m-0 text-white"> Instagram: @undangan_trenggalek</p>
                </div>
                <div class="col-md-4 ps-5">
                    <p class="m-0 text-white"><strong> Kami Melayani : </strong></p>
                    <p class="m-0 text-white">Undangan Pernikahan harga mulai Rp 900,- </p>
                    <p class="m-0 text-white">Undangan Digital (Video)</p>
                    <p class="m-0 text-white">Amplop pernikhan</p>
                    <p class="m-0 text-white">Stiker Full Colour</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
