<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Your CSS / Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
    body {
        background: url('/images/login-bg.jpg') no-repeat center center/cover;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.07);
        padding: 40px;
        border-radius: 20px;
        backdrop-filter: blur(10px);
        width: 350px;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
    }

    .logo-circle {
        width: 80px;
        height: 80px;
        border: 2px solid white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
        font-size: 32px;
        color: white;
        font-weight: bold;
    }

    .form-control {
        background: rgba(255,255,255,0.2) !important;
        border: none !important;
        color: white !important;
    }

    .form-control::placeholder {
        color: #ddd !important;
    }

    .btn-main {
        background: #ff416c;
        border: none;
        padding: 10px;
        width: 100%;
        border-radius: 25px;
        color: white;
        font-weight: bold;
    }

    label, h2, a {
        color: white !important;
    }

    .auth-wrapper {
        display: flex;
        justify-content: center;
        width: 100%;
    }
</style>

</head>

<body class="bg-light">

    <div class="container mt-5" style="max-width: 500px;">
        @yield('content')
    </div>

</body>
</html>
