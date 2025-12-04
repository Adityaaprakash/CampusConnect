@extends('layouts.app')

@section('content')

    <div class="text-center py-5">

        <div class="mb-5">
            <h1 class="display-3 fw-bold mb-3">
                Welcome to <span class="text-primary-gradient">CampusConnect</span> 👋
            </h1>
            <p class="lead text-muted mb-4 mx-auto" style="max-width: 600px;">
                Your all-in-one student platform. Access notes, join chat rooms, order food, and find the perfect place to
                stay.
            </p>

            @auth
                <div class="glass-card d-inline-block px-4 py-2 mb-4">
                    <p class="mb-0 text-muted small">Logged in as</p>
                    <p class="mb-0 fw-bold">{{ auth()->user()->name }}</p>
                    <div class="mt-2 badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                        Credits: {{ auth()->user()->credit_balance }}
                    </div>
                </div>
            @endauth
        </div>

        <div class="row g-4 justify-content-center">

            <!-- Notes Card -->
            <div class="col-md-6 col-lg-3">
                <div class="glass-card p-4 h-100 d-flex flex-column align-items-center transition-hover">
                    <div class="mb-3 p-3 rounded-circle bg-primary bg-opacity-10 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            class="bi bi-journal-text" viewBox="0 0 16 16">
                            <path
                                d="M5 0h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM1 2v14a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1zm4 0h6a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zm2 1.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-4zm0 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-4zm0 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-4z" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-2">Notes Section</h5>
                    <p class="text-muted small mb-4">Upload and share study materials with your peers.</p>
                    <a href="{{ route('notes.view') }}" class="btn btn-outline-custom w-100 mt-auto">Browse Notes</a>
                </div>
            </div>

            <!-- Chat Card -->
            <div class="col-md-6 col-lg-3">
                <div class="glass-card p-4 h-100 d-flex flex-column align-items-center transition-hover">
                    <div class="mb-3 p-3 rounded-circle bg-success bg-opacity-10 text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            class="bi bi-chat-dots" viewBox="0 0 16 16">
                            <path
                                d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            <path
                                d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-2">Chat Room</h5>
                    <p class="text-muted small mb-4">Connect with students in public or private rooms.</p>
                    <a href="{{ route('chat.index') }}" class="btn btn-outline-custom w-100 mt-auto">Join Chat</a>
                </div>
            </div>

            <!-- Food Card -->
            <div class="col-md-6 col-lg-3">
                <div class="glass-card p-4 h-100 d-flex flex-column align-items-center transition-hover">
                    <div class="mb-3 p-3 rounded-circle bg-warning bg-opacity-10 text-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            class="bi bi-cart3" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.835 4.385 8.416-.42L11.723 4H3.102zM11 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-5 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-2">Order Food</h5>
                    <p class="text-muted small mb-4">Order delicious meals from campus canteens.</p>
                    <a href="{{ route('food.index') }}" class="btn btn-outline-custom w-100 mt-auto">Order Now</a>
                </div>
            </div>

            <!-- Rent Card -->
            <div class="col-md-6 col-lg-3">
                <div class="glass-card p-4 h-100 d-flex flex-column align-items-center transition-hover">
                    <div class="mb-3 p-3 rounded-circle bg-info bg-opacity-10 text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            class="bi bi-house-door" viewBox="0 0 16 16">
                            <path
                                d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                        </svg>
                    </div>
                    <h5 class="fw-bold mb-2">Rent/PG</h5>
                    <p class="text-muted small mb-4">Find nearby PGs and rental apartments easily.</p>
                    <a href="{{ route('rent.index') }}" class="btn btn-outline-custom w-100 mt-auto">Find Home</a>
                </div>
            </div>

        </div>

    </div>

@endsection