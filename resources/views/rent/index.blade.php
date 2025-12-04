@extends('layouts.app')

@section('content')
    {{-- Hero Banner --}}
    <div class="card border-0 shadow-lg mb-4 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-7">
                <img src="https://images.pexels.com/photos/439391/pexels-photo-439391.jpeg"
                    alt="Hostel / PG" class="img-fluid h-100 w-100 object-fit-cover">
            </div>
            <div class="col-md-5 d-flex align-items-center">
                <div class="p-4">
                    <h1 class="fw-bold mb-2">Find Rooms, PGs & Flats Near Campus</h1>
                    <p class="text-muted mb-4">Affordable, verified and student-friendly stays.</p>
                    <a href="{{ route('rent.listings') }}" class="btn btn-red btn-lg">
                        View All Listings
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Add CTA --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Latest Listings</h4>
        <a href="{{ route('rent.create') }}" class="btn btn-outline-red btn-sm">
            + Add Your Property
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
            <p class="text-muted">No listings yet. Be the first to add a property!</p>
        @endforelse
    </div>
@endsection


