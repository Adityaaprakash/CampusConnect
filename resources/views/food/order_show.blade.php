@extends('layouts.app')

@section('content')
    <h2 class="mb-3">Order #{{ $order->id }}</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="mb-1">Restaurant</h5>
                    <p class="mb-3">{{ $order->restaurant->name }}</p>

                    <h5 class="mb-2">Items</h5>
                    @foreach ($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <div class="fw-semibold">{{ $item->menuItem->item ?? 'Item' }}</div>
                                <div class="text-muted small">
                                    Qty: {{ $item->qty }} × ₹{{ $item->price }}
                                </div>
                            </div>
                            <div class="fw-bold">
                                ₹{{ $item->qty * $item->price }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-2">Order Summary</h5>
                    <p class="mb-1 d-flex justify-content-between">
                        <span>Total</span>
                        <span>₹{{ $order->total_amount }}</span>
                    </p>
                    <p class="mb-1 d-flex justify-content-between">
                        <span>Credits Used</span>
                        <span>{{ $order->credits_used }}</span>
                    </p>
                    <hr>
                    <p class="mb-1">
                        <span class="fw-semibold">Status:</span>
                        @php
                            $labels = [
                                'received' => 'Order Received',
                                'preparing' => 'Preparing',
                                'ready' => 'Ready for Pickup',
                            ];
                        @endphp
                        <span class="badge bg-info text-dark">
                            {{ $labels[$order->status] ?? ucfirst($order->status) }}
                        </span>
                    </p>
                    <p class="text-muted small mt-2 mb-0">
                        Please show this screen at the counter when picking up your order.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection