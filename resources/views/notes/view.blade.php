@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8fafc;
    }
    .notes-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
    }
    .note-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        transition: 0.25s;
    }
    .note-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    .note-title {
        font-size: 1.3rem;
        color: #0d6efd;
        font-weight: 600;
        text-decoration: none;
    }
    .note-title:hover {
        text-decoration: underline;
    }
</style>

<div class="notes-container">

    {{-- PAGE TITLE --}}
    <h3 class="mb-4 text-center">📚 Notes Library</h3>

    {{-- UPLOAD BUTTON (only for logged-in users) --}}
    @auth
    <div class="text-center mb-4">
        <a href="{{ route('notes.upload') }}" class="btn btn-primary px-4">
            ➕ Upload Notes
        </a>
    </div>
    @endauth

    {{-- NO NOTES AVAILABLE --}}
    @if($notes->count() == 0)
        <div class="alert alert-warning text-center">
            No notes available yet. Please check again later.
        </div>
    @endif

    {{-- NOTES LIST --}}
    @foreach($notes as $note)
        <div class="note-card">

            <a href="{{ asset('uploads/'.$note->file_name) }}" target="_blank" class="note-title">
                {{ $note->title }}
            </a>

            <p class="mb-1"><strong>Department:</strong> {{ $note->department }}</p>
            <p class="mb-1"><strong>Semester:</strong> {{ $note->semester }}</p>
            <p class="mb-1"><strong>Subject:</strong> {{ $note->subject }}</p>

            <p class="mb-2 text-muted">{{ $note->description }}</p>

            <a href="{{ asset('uploads/'.$note->file_name) }}" class="btn btn-dark btn-sm" target="_blank">
                📄 View PDF
            </a>

        </div>
    @endforeach

</div>
@endsection

