@extends('layouts.admin')

@section('content')
    <h2 class="mb-3">Food Orders</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Outlet</th>
                    <th>Total (₹)</th>
                    <th>Credits Used</th>
                    <th>Status</th>
                    <th>Placed At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'User ' . $order->user_id }}</td>
                        <td>{{ $order->outlet->name ?? 'Outlet ' . $order->outlet_id }}</td>
                        <td>{{ $order->total_amount }}</td>
                        <td>{{ $order->credits_used }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                        </td>
                        <td>{{ $order->created_at->format('d M H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.food.orders.status', $order) }}" method="POST"
                                class="d-flex gap-1">
                                @csrf
                                <select name="status" class="form-select form-select-sm">
                                    <option value="received" {{ $order->status === 'received' ? 'selected' : '' }}>Received
                                    </option>
                                    <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>
                                        Preparing</option>
                                    <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Ready</option>
                                </select>
                                <button class="btn btn-sm btn-primary" type="submit">Update</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $orders->links() }}
    </div>
@endsection


