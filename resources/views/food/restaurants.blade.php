@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold">Campus Restaurants</h2>
    <a href="{{ route('food.index') }}" class="btn btn-outline-red">Back</a>
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
                    <p class="text-muted small mb-2">
                        Location: {{ $restaurant->location ?? 'N/A' }}
                    </p>

                    <a href="{{ route('food.menu', $restaurant) }}" 
                       class="btn btn-red mt-auto">
                        View Menu
                    </a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">No restaurants available.</p>
    @endforelse
</div>
@endsection
