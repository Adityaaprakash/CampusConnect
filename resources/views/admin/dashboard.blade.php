@extends('layouts.admin')

@section('content')

<div class="container text-center">
    <h3 class="mb-4 dashboard-title">📊 Admin Dashboard Overview</h3>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card py-4">
                <div class="card-body">
                    <i class="bi bi-people text-info"></i>
                    <h5>Total Users</h5>
                    <h3 class="fw-bold text-info">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card py-4">
                <div class="card-body">
                    <i class="bi bi-hourglass-split text-warning"></i>
                    <h5>Pending Notes</h5>
                    <h3 class="fw-bold text-warning">{{ $pendingNotes }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card py-4">
            <div class="card-body">
                <i class="bi bi-check-circle text-success"></i>
                <h5>Approved Notes</h5>
                <h3 class="fw-bold text-success">{{ $approvedNotes }}</h3>
            </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card py-4">
                <div class="card-body">
                    <i class="bi bi-x-circle text-danger"></i>
                    <h5>Rejected Notes</h5>
                    <h3 class="fw-bold text-danger">{{ $rejectedNotes }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('admin.notes.pending') }}" class="btn btn-primary rounded-pill px-4 py-2">
            🧾 Review Pending Notes
        </a>
    </div>

    <div class="mt-5">
        <p class="footer-text small">© {{ date('Y') }} CampusConnect Admin Panel</p>
    </div>
</div>

@endsection
