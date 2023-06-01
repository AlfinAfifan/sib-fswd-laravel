
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Perpustakaan</title>
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
</head>
<body>
    <div class="container" style="background-image: url('{{ asset("img/login.jpg") }}');">
        <form action="{{ route('login.authenticate') }}" method="post">
            @csrf
            <h1>Login Here</h1>

            @if (Session::get('success'))
            <p style="color: green;">{{ session('success') }}</p>
            @else
            <p style="color: red;">{{ session('error') }}</p>
            @endif

            <input type="email" name="email" placeholder="Enter Your Email">
            <input type="password" name="password" placeholder="Enter Your Password">
            <button type="submit" name="login">Login</button>
            <p class="first">Don't have an account?</p>
            <p class="second"><a href="{{ route('register') }}">Sign up</a> here</p>
        </form>
    </div>
</body>
</html>
