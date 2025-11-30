@extends('layouts.guest')

@section('title', 'Register')

@section('content')

<div class="auth-wrapper">
    <div class="login-card text-center">

        <div class="logo-circle">
            CC
        </div>

        <h2 class="mt-3 text-white">CampusConnect</h2>

        <form action="{{ route('register') }}" method="POST" class="mt-4">
            @csrf

            <input type="text" name="name" placeholder="Name" class="form-control mb-3" required>

            <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>

            <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>

            <button type="submit" class="btn-main">Register</button>
        </form>

        <a href="{{ route('login') }}" class="d-block mt-3">Already have an account? Login</a>

    </div>
</div>

@endsection
