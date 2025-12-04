@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-3 shadow-sm">
                @php
                    $mainImage = $property->images->first();
                @endphp
                @if ($mainImage)
                    <img src="{{ str_starts_with($mainImage->image_path, 'http') ? $mainImage->image_path : asset('storage/' . $mainImage->image_path) }}" class="card-img-top"
                        alt="{{ $property->title }}">
                @else
                    <img src="https://images.pexels.com/photos/439391/pexels-photo-439391.jpeg" class="card-img-top"
                        alt="{{ $property->title }}">
                @endif

                <div class="card-body">
                    <h2 class="card-title mb-1">{{ $property->title }}</h2>
                    @if ($property->full_address)
                        <p class="text-muted mb-2">{{ $property->full_address }}</p>
                    @else
                        <p class="text-muted mb-2">{{ $property->location }}</p>
                    @endif

                    <p class="h5 text-red-custom mb-2">₹{{ number_format($property->rent) }}/month</p>

                    @if ($property->deposit)
                        <p class="mb-2">
                            <span class="fw-semibold">Deposit:</span>
                            ₹{{ number_format($property->deposit) }}
                        </p>
                    @endif

                    <p class="mb-2">
                        <span class="fw-semibold">Availability:</span>
                        <span
                            class="badge" style="{{ $property->availability_status === 'available' ? 'background-color: #dc143c; color: white;' : 'background-color: #666; color: white;' }}">
                            {{ ucfirst($property->availability_status) }}
                        </span>
                    </p>

                    @if (!empty($amenities))
                        <hr>
                        <h5>Amenities</h5>
                        <ul class="list-inline mb-2">
                            @foreach ($amenities as $amenity)
                                <li class="list-inline-item badge" style="background-color: rgba(220, 20, 60, 0.2); color: #dc143c; border: 1px solid rgba(220, 20, 60, 0.5);">
                                    {{ $amenity }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if ($property->description)
                        <hr>
                        <h5>Description</h5>
                        <p class="mb-0">{{ $property->description }}</p>
                    @endif
                </div>
            </div>

            {{-- Optional: thumbnail gallery --}}
            @if ($property->images->count() > 1)
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Photos</h5>
                        <div class="row g-2">
                            @foreach ($property->images as $image)
                                <div class="col-4 col-md-3">
                                    <img src="{{ str_starts_with($image->image_path, 'http') ? $image->image_path : asset('storage/' . $image->image_path) }}" alt="Photo"
                                        class="img-fluid rounded">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5>Contact Owner / Agent</h5>
                    <p class="mb-1">
                        <span class="fw-semibold">Name:</span>
                        {{ $property->owner_name }}
                    </p>
                    <p class="mb-2">
                        <span class="fw-semibold">Phone:</span>
                        <a href="tel:{{ $property->phone }}">{{ $property->phone }}</a>
                    </p>

                    <a href="tel:{{ $property->phone }}" class="btn btn-red w-100 mb-2">
                        Call Owner
                    </a>
                </div>
            </div>

            @auth
                @if (auth()->user()->role === 'admin')
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="text-danger">Admin Actions</h6>
                            <form action="{{ route('admin.rent.destroy', $property) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this property?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-red w-100">
                                    Delete Property
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>
@endsection


