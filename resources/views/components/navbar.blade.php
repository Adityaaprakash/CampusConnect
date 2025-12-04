<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container">

        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}"
            style="font-size: 1.5rem;">
            <span style="color: var(--primary-color);">Campus</span><span
                style="color: var(--text-main);">Connect</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- LEFT SIDE NAV LINKS -->
            @auth
                <ul class="navbar-nav me-auto ms-lg-4 gap-3">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('notes.*') ? 'active' : '' }}"
                            href="{{ route('notes.view') }}">Notes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('chat.*') ? 'active' : '' }}"
                            href="{{ route('chat.index') }}">Chat Room</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('food.*') ? 'active' : '' }}"
                            href="{{ route('food.index') }}">Order Food</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('rent.*') ? 'active' : '' }}"
                            href="{{ route('rent.index') }}">Rent/PG</a>
                    </li>

                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        </li>
                    @endif

                </ul>
            @endauth


            <!-- RIGHT SIDE USER & LOGOUT -->
            <ul class="navbar-nav ms-auto gap-2 align-items-center">

                <li class="nav-item me-2">
                    <button class="btn btn-outline-custom btn-sm d-flex align-items-center justify-content-center"
                        onclick="toggleTheme()" style="width: 32px; height: 32px; padding: 0; border-radius: 50%;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
                            <path
                                d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
                            <path
                                d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
                        </svg>
                    </button>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-custom btn-sm" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary-custom btn-sm" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest


                @auth
                    <li class="nav-item d-flex align-items-center me-3">
                        <div class="d-flex flex-column text-end lh-1">
                            <span class="fw-bold">{{ auth()->user()->name }}</span>
                            <small class="text-muted"
                                style="font-size: 0.75rem;">{{ ucfirst(auth()->user()->role) }}</small>
                        </div>
                    </li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button class="btn btn-outline-custom btn-sm">Logout</button>
                        </form>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>