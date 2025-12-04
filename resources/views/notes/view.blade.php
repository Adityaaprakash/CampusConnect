@extends('layouts.app')

@section('content')
<style>
    .notes-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
    }
    .note-card {
        background: rgba(20, 20, 20, 0.9);
        border: 1px solid rgba(220, 20, 60, 0.3);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(220, 20, 60, 0.2);
        margin-bottom: 20px;
        transition: 0.25s;
        color: #ffffff;
    }
    .note-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(220, 20, 60, 0.4);
        border-color: rgba(220, 20, 60, 0.6);
    }
    .note-title {
        font-size: 1.3rem;
        color: #dc143c;
        font-weight: 600;
        text-decoration: none;
    }
    .note-title:hover {
        text-decoration: underline;
        color: #b01030;
    }
</style>

<div class="notes-container">

    {{-- PAGE TITLE --}}
    <h3 class="mb-4 text-center">📚 Notes Library</h3>

    {{-- UPLOAD BUTTON (only for logged-in users) --}}
    @auth
    <div class="text-center mb-4">
        <a href="{{ route('notes.upload') }}" class="btn btn-red px-4">
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

            <a href="{{ asset('uploads/'.$note->file_name) }}" class="btn btn-outline-red btn-sm" target="_blank">
                📄 View PDF
            </a>

        </div>
    @endforeach

</div>
@endsection

