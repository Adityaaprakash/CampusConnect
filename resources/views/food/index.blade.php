@extends('layouts.app')

@section('content')
    {{-- HERO BANNER --}}
    <div class="card border-0 shadow-lg mb-4 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-7">
                <img src="https://images.pexels.com/photos/958545/pexels-photo-958545.jpeg"
                     alt="Campus food" class="img-fluid h-100 w-100 object-fit-cover">
            </div>
            <div class="col-md-5 d-flex align-items-center">
                <div class="p-4">
                    <h1 class="fw-bold mb-2">Order Food From Campus Canteens</h1>
                    <p class="text-muted mb-3">Skip the queue. Collect easily.</p>

                    {{-- FIXED ROUTE --}}
                    <a href="{{ route('food.restaurants') }}" class="btn btn-red btn-lg">
                        Browse Restaurants
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- RESTAURANT LIST (Preview) --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Canteens & Restaurants</h4>

        {{-- FIXED ROUTE --}}
        <a href="{{ route('food.restaurants') }}" class="btn btn-outline-red btn-sm">
            View All
        </a>
    </div>

    <div class="row g-3">
        @forelse ($restaurants as $restaurant)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">

                    {{-- IMAGE --}}
                    @if ($restaurant->image)
                        <img src="{{ str_starts_with($restaurant->image, 'http') ? $restaurant->image : asset('storage/' . $restaurant->image) }}" 
                             class="card-img-top" 
                             alt="{{ $restaurant->name }}">
                    @else
                        <img src="https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg" 
                             class="card-img-top"
                             alt="{{ $restaurant->name }}">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $restaurant->name }}</h5>
                        <p class="text-muted small mb-1">
                            Location: {{ $restaurant->location ?? 'N/A' }}
                        </p>

                        {{-- MENU LINK FIXED --}}
                        <a href="{{ route('food.menu', $restaurant) }}" 
                           class="btn btn-outline-red mt-auto">
                            View Menu
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No restaurants added yet.</p>
        @endforelse
    </div>
@endsection


