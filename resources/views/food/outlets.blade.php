@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="mb-0">Campus Canteens</h2>
            <p class="text-muted mb-0">Choose an outlet and order your favourites.</p>
        </div>
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
            <p class="text-muted">No outlets available.</p>
        @endforelse
    </div>
@endsection


