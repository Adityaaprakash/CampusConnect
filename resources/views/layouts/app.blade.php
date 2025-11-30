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
            background-color: #f8f9fa;
        }
    </style>

</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">CampusConnect</a>

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
                            <a href="/login" class="btn btn-outline-light me-2">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="btn btn-primary">Register</a>
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
                                <button class="btn btn-danger">Logout</button>
                            </form>
                        </li>
                    @endauth

                </ul>

            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
