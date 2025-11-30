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
                    <a href="{{ route('food.outlets') }}" class="btn btn-warning btn-lg">
                        Browse Restaurants
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- OUTLET LIST (optional preview) --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Canteens & Outlets</h4>
        <a href="{{ route('food.outlets') }}" class="btn btn-outline-secondary btn-sm">View All</a>
    </div>

    <div class="row g-3">
        @forelse ($outlets as $outlet)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if ($outlet->image)
                        <img src="{{ asset('storage/' . $outlet->image) }}" class="card-img-top"
                            alt="{{ $outlet->name }}">
                    @else
                        <img src="https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg" class="card-img-top"
                            alt="{{ $outlet->name }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $outlet->name }}</h5>
                        <p class="text-muted small mb-1">
                            Min order: ₹{{ number_format($outlet->min_order) }}
                        </p>
                        <span
                            class="badge {{ $outlet->status === 'open' ? 'bg-success' : 'bg-secondary' }} mb-2">{{ ucfirst($outlet->status) }}</span>
                        <a href="{{ route('food.menu', $outlet) }}" class="btn btn-outline-primary mt-auto">
                            View Menu
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No outlets added yet.</p>
        @endforelse
    </div>
@endsection


