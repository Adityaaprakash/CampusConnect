@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4 text-center">📥 Pending Notes Approval</h2>

    @if($notes->count() == 0)
        <div class="alert alert-info text-center">
            No pending notes right now.
        </div>
    @else

        @foreach($notes as $note)
            <div class="card mb-3">
                <div class="card-body">

                    <h5 class="card-title">{{ $note->title }}</h5>

                    <p><strong>Department:</strong> {{ $note->department }}</p>
                    <p><strong>Semester:</strong> {{ $note->semester }}</p>
                    <p><strong>Subject:</strong> {{ $note->subject }}</p>
                    <p class="text-muted">{{ $note->description }}</p>

                    <a href="{{ asset('uploads/' . $note->file_name) }}" class="btn btn-primary btn-sm" target="_blank">
                        📄 View PDF
                    </a>

                    <div class="mt-3">
                        <form action="{{ route('admin.notes.approve', $note->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>

                        <form action="{{ route('admin.notes.reject', $note->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach

    @endif

</div>

@endsection
