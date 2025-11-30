@extends('layouts.app')

@section('content')
    <h2 class="mb-3">Your Cart</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (empty($cart))
        <p class="text-muted">Your cart is empty.</p>
    @else
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Items</h5>
                        @foreach ($cart as $row)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                <div>
                                    <div class="fw-semibold">{{ $row['name'] }}</div>
                                    <div class="text-muted small">
                                        Qty: {{ $row['qty'] }} × ₹{{ $row['price'] }}
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold mb-1">₹{{ $row['qty'] * $row['price'] }}</div>
                                    <form action="{{ route('food.cart.remove', $row['menu_item_id']) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-red">Remove</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3">Summary</h5>
                        <p class="mb-1 d-flex justify-content-between">
                            <span>Subtotal</span>
                            <span>₹{{ $cartTotal }}</span>
                        </p>
                        <p class="mb-1 d-flex justify-content-between">
                            <span>Your Credits</span>
                            <span>{{ $credits }}</span>
                        </p>
                        <hr>
                        <form action="{{ route('food.checkout') }}" method="POST">
                            @csrf
                            <div class="mb-2">
                                <label class="form-label">Credits to use</label>
                                <input type="number" name="credits_to_use" class="form-control" min="0"
                                    max="{{ min($credits, $cartTotal) }}" value="{{ min($credits, $cartTotal) }}">
                            </div>
                            <button type="submit" class="btn btn-red w-100">
                                Place Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


