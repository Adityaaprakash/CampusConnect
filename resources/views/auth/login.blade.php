@extends('layouts.guest')

@section('title', 'Login')

@section('content')

    <div class="auth-wrapper">
        <div class="login-card text-center">

            <div class="logo-circle">
                CC
            </div>

            <h2 class="mt-3">CampusConnect</h2>

            @if ($errors->any())
                <div class="alert alert-danger text-start">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.perform') }}" method="POST" class="mt-4">
                @csrf

                <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>

                <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>

                <button type="submit" class="btn-main">Log In</button>
            </form>

            <a href="{{ route('register') }}" class="d-block mt-3">Don't have an account? Register</a>

        </div>
    </div>

@endsection