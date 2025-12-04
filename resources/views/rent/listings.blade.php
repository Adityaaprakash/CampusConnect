@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="mb-0">All Rental Listings</h2>
            <p class="text-muted mb-0">Browse PGs, rooms and flats near campus.</p>
        </div>
        <a href="{{ route('rent.create') }}" class="btn btn-outline-red btn-sm">
            + Add Property
        </a>
    </div>

    <div class="row g-3">
        @forelse ($properties as $property)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @php
                        $image = $property->images->first();
                    @endphp
                    @if ($image)
                        <img src="{{ str_starts_with($image->image_path, 'http') ? $image->image_path : asset('storage/' . $image->image_path) }}" class="card-img-top"
                            alt="{{ $property->title }}">
                    @else
                        <img src="https://images.pexels.com/photos/259588/pexels-photo-259588.jpeg" class="card-img-top"
                            alt="{{ $property->title }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">{{ $property->title }}</h5>
                        <p class="text-red-custom fw-bold mb-1">₹{{ number_format($property->rent) }}/month</p>
                        <p class="text-muted small mb-2">{{ $property->location }}</p>
                        <p class="small mb-2">
                            <span class="fw-semibold">Owner:</span>
                            {{ $property->owner_name }}
                        </p>
                        <a href="{{ route('rent.show', $property) }}" class="btn btn-outline-red mt-auto">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No properties found.</p>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $properties->links() }}
    </div>
@endsection


