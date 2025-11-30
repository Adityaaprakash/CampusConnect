<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusConnect</title>

    <!-- BOOTSTRAP CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #000000 0%, #1a0000 50%, #000000 100%);
            background-attachment: fixed;
            min-height: 100vh;
            color: #ffffff;
        }
        
        /* Aesthetic background pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(220, 20, 60, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(220, 20, 60, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(220, 20, 60, 0.06) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }
        
        .container {
            position: relative;
            z-index: 1;
        }
        
        /* Custom red color for Bootstrap */
        .bg-red-custom {
            background-color: #dc143c !important;
        }
        
        .text-red-custom {
            color: #dc143c !important;
        }
        
        .border-red-custom {
            border-color: #dc143c !important;
        }
        
        .btn-red {
            background-color: #dc143c;
            border-color: #dc143c;
            color: #ffffff;
        }
        
        .btn-red:hover {
            background-color: #b01030;
            border-color: #b01030;
            color: #ffffff;
        }
        
        .btn-outline-red {
            border-color: #dc143c;
            color: #dc143c;
        }
        
        .btn-outline-red:hover {
            background-color: #dc143c;
            border-color: #dc143c;
            color: #ffffff;
        }
        
        /* Card styling */
        .card {
            background-color: rgba(20, 20, 20, 0.9);
            border: 1px solid rgba(220, 20, 60, 0.3);
            color: #ffffff;
        }
        
        .card-title {
            color: #ffffff;
        }
        
        .text-muted {
            color: #aaaaaa !important;
        }
        
        /* Form controls */
        .form-control {
            background-color: rgba(30, 30, 30, 0.9);
            border: 1px solid rgba(220, 20, 60, 0.3);
            color: #ffffff;
        }
        
        .form-control:focus {
            background-color: rgba(30, 30, 30, 0.9);
            border-color: #dc143c;
            color: #ffffff;
            box-shadow: 0 0 0 0.2rem rgba(220, 20, 60, 0.25);
        }
        
        .form-control::placeholder {
            color: #888888;
        }
    </style>

</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000000; border-bottom: 2px solid #dc143c;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}" style="color: #dc143c !important; font-size: 1.5rem;">CampusConnect</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                {{-- LEFT SIDE NAV LINKS --}}
                @auth
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notes.view') }}">Notes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chat.index') }}">Chat</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('food.index') }}">Food</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rent.index') }}">Rent</a>
                    </li>

                </ul>
                @endauth

                {{-- RIGHT SIDE – LOGIN, REGISTER, USER, LOGOUT --}}
                <ul class="navbar-nav ms-auto">

                    {{-- For Guests --}}
                    @guest
                        <li class="nav-item">
                            <a href="/login" class="btn btn-outline-red me-2">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="btn btn-red">Register</a>
                        </li>
                    @endguest

                    {{-- For Logged-In Users --}}
                    @auth
                        <li class="nav-item d-flex align-items-center text-white me-3">
                            {{ auth()->user()->name }} ({{ auth()->user()->role }})
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-red">Logout</button>
                            </form>
                        </li>
                    @endauth

                </ul>

            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <div class="container mt-4 mb-5">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
