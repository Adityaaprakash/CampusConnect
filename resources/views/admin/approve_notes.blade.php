@extends('layouts.admin')

@section('content')

<style>
    body {
        background: #0d1117;
        color: #e6edf3;
    }
    .note-card {
        background: #161b22;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 25px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.5);
        transition: .25s;
    }
    .note-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 25px rgba(88,166,255,0.25);
    }
    .note-title {
        color: #58a6ff;
        font-size: 1.4rem;
        font-weight: 600;
        text-decoration: none;
    }
    .note-title:hover {
        opacity: 0.85;
    }
</style>

<div class="container my-5">

    <h3 class="text-center mb-4">🧾 Pending Notes for Approval</h3>

    {{-- SUCCESS / ERROR --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif


    @forelse($pendingNotes as $note)
        <div class="note-card">

            <a href="{{ asset('uploads/'.$note->file_name) }}" target="_blank" class="note-title">
                {{ $note->title }}
            </a>

            <p class="mb-1"><strong>Uploaded by:</strong> {{ $note->user->name }} ({{ $note->user->email }})</p>
            <p class="mb-1"><strong>Department:</strong> {{ $note->department }} |
               <strong>Semester:</strong> {{ $note->semester }}</p>

            <p class="mb-1"><strong>Subject:</strong> {{ $note->subject }}</p>
            <p class="text-muted mb-3">{{ $note->description }}</p>

            <div class="d-flex gap-2">
                <a href="{{ asset('uploads/'.$note->file_name) }}" class="btn btn-outline-primary" target="_blank">📄 View PDF</a>

                <form method="POST" action="{{ route('admin.notes.approve', $note->id) }}">
                    @csrf
                    <button class="btn btn-success">✅ Approve</button>
                </form>

                <form method="POST" action="{{ route('admin.notes.reject', $note->id) }}">
                    @csrf
                    <button class="btn btn-danger">❌ Reject</button>
                </form>
            </div>
        </div>

    @empty
        <div class="alert alert-warning text-center">🎉 No pending notes!</div>
    @endforelse
</div>

@endsection
