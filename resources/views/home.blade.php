@extends('layouts.app')

@section('content')

<div class="text-center">

    <h1 class="fw-bold mb-3" style="color: #dc143c;">Welcome to CampusConnect 👋</h1>

    <p class="text-muted mb-4">
        Your one-stop student platform for notes, food, rentals, and chat!
    </p>

    @auth
        <p class="mb-2">
            You are logged in as <b>{{ auth()->user()->email }}</b>
            ({{ auth()->user()->role }})
        </p>
        <p class="mb-4 text-muted">
            Your Credits: <b>{{ auth()->user()->credit_balance }}</b>
        </p>
    @endauth

    <div class="d-flex justify-content-center flex-wrap gap-3">

        <a href="{{ route('notes.view') }}" class="btn btn-red px-4 me-2 mb-2">📘 Notes Section</a>
        <a href="{{ route('chat.index') }}" class="btn btn-red px-4 me-2 mb-2">💬 Chat Room</a>
        <a href="{{ route('food.index') }}" class="btn btn-red px-4 me-2 mb-2">🍔 Order Food</a>
        <a href="{{ route('rent.index') }}" class="btn btn-red px-4 mb-2">🏠 Rent/PG Listings</a>

    </div>

</div>

@endsection
