<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('home') }}">CampusConnect</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- LEFT SIDE NAV LINKS -->
            @auth
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('notes.view') }}">Notes</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('chat.index') }}">Chat Room</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('food.index') }}">Order Food</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rent.index') }}">Rent/PG</a>
                </li>

            </ul>
            @endauth


            <!-- RIGHT SIDE USER & LOGOUT -->
            <ul class="navbar-nav ms-auto">

                @guest
                    <li class="nav-item">
                        <a class="btn btn-primary me-2" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest


                @auth
                    <li class="nav-item d-flex align-items-center text-white me-3">
                        {{ auth()->user()->name }} ({{ auth()->user()->role }})
                    </li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>
