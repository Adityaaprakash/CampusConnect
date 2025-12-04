@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="mb-0">{{ $restaurant->name }}</h2>
            <p class="text-muted mb-0">Browse the menu and add items to your cart.</p>
        </div>
        <div class="text-end">
            <p class="mb-1">
                <span class="fw-semibold">Your Credits:</span>
                {{ $credits }}
            </p>
            <a href="{{ route('food.cart') }}" class="btn btn-outline-red btn-sm">
                Cart (₹{{ $cartTotal }})
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row g-3">
        @forelse ($items as $item)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if ($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->item }}">
                    @else
                        <img src="https://images.pexels.com/photos/1438672/pexels-photo-1438672.jpeg" class="card-img-top"
                            alt="{{ $item->item }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">{{ $item->item }}</h5>
                        <p class="text-red-custom fw-bold mb-2">₹{{ number_format($item->price) }}</p>
                        <form action="{{ route('food.cart.add', $item) }}" method="POST" class="mt-auto">
                            @csrf
                            <div class="input-group input-group-sm mb-2" style="max-width: 140px;">
                                <span class="input-group-text">Qty</span>
                                <input type="number" name="qty" value="1" min="1" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-sm btn-red w-100">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No items available in this outlet.</p>
        @endforelse
    </div>
@endsection