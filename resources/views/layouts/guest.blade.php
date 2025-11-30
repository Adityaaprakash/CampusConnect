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
        background: linear-gradient(135deg, #000000 0%, #1a0000 50%, #000000 100%);
        background-attachment: fixed;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }
    
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 20% 50%, rgba(220, 20, 60, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(220, 20, 60, 0.12) 0%, transparent 50%),
            radial-gradient(circle at 40% 20%, rgba(220, 20, 60, 0.1) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    .login-card {
        background: rgba(20, 20, 20, 0.95);
        padding: 40px;
        border-radius: 20px;
        backdrop-filter: blur(10px);
        width: 350px;
        box-shadow: 0 0 30px rgba(220, 20, 60, 0.3);
        border: 2px solid rgba(220, 20, 60, 0.5);
        position: relative;
        z-index: 1;
    }

    .logo-circle {
        width: 80px;
        height: 80px;
        border: 3px solid #dc143c;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
        font-size: 32px;
        color: #dc143c;
        font-weight: bold;
        background: rgba(220, 20, 60, 0.1);
    }

    .form-control {
        background: rgba(30, 30, 30, 0.9) !important;
        border: 1px solid rgba(220, 20, 60, 0.3) !important;
        color: white !important;
    }
    
    .form-control:focus {
        background: rgba(30, 30, 30, 0.9) !important;
        border-color: #dc143c !important;
        color: white !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 20, 60, 0.25) !important;
    }

    .form-control::placeholder {
        color: #888 !important;
    }

    .btn-main {
        background: #dc143c;
        border: none;
        padding: 10px;
        width: 100%;
        border-radius: 25px;
        color: white;
        font-weight: bold;
        transition: all 0.3s;
    }
    
    .btn-main:hover {
        background: #b01030;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 20, 60, 0.4);
    }

    label, h2, a {
        color: white !important;
    }
    
    a:hover {
        color: #dc143c !important;
    }

    .auth-wrapper {
        display: flex;
        justify-content: center;
        width: 100%;
        position: relative;
        z-index: 1;
    }
</style>

</head>

<body class="bg-light">

    <div class="container mt-5" style="max-width: 500px;">
        @yield('content')
    </div>

</body>
</html>
