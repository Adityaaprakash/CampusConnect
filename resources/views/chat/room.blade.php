@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="mb-0">{{ $room->room_name }}</h3>
                    <small class="text-muted">
                        {{ $room->type === 'private' ? 'Private room' : 'Public room' }}
                    </small>
                </div>
                <a href="{{ route('chat.index') }}" class="btn btn-outline-secondary btn-sm">Back to rooms</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card mb-3" style="height: 400px; overflow-y: auto;">
                <div class="card-body" id="messages" data-room-id="{{ $room->id }}">
                    @forelse ($messages as $message)
                        <div class="mb-2">
                            <strong>{{ $message->user->name ?? 'User ' . $message->user_id }}</strong>
                            <span class="text-muted small">
                                • {{ $message->created_at->format('d M H:i') }}
                            </span>
                            <div>
                                {{ $message->message_text }}
                            </div>
                        </div>
                    @empty
                        <p class="text-muted" id="no-messages">No messages yet. Start the conversation!</p>
                    @endforelse
                </div>
            </div>

            <form action="{{ route('chat.messages.store', $room) }}" method="POST" class="d-flex gap-2" id="message-form">
                @csrf
                <input type="text" name="message_text" class="form-control" id="message-input" placeholder="Type a message..."
                    autocomplete="off" required>
                <button class="btn btn-primary" type="submit">Send</button>
            </form>

            @error('message_text')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const messagesEl = document.getElementById('messages');
                const roomId = messagesEl.dataset.roomId;
                const messageForm = document.getElementById('message-form');
                const messageInput = document.getElementById('message-input');
                const noMessagesEl = document.getElementById('no-messages');

                function scrollToBottom() {
                    const card = messagesEl.closest('.card');
                    card.scrollTop = card.scrollHeight;
                }

                // Listen for broadcasted messages on private channel
                if (window.Echo) {
                    window.Echo.private('chat.room.' + roomId)
                        .listen('.MessageSent', (e) => {
                            if (noMessagesEl) {
                                noMessagesEl.remove();
                            }

                            const wrapper = document.createElement('div');
                            wrapper.classList.add('mb-2');
                            wrapper.innerHTML = `
                                <strong>${e.user_name}</strong>
                                <span class="text-muted small"> • ${e.created_at}</span>
                                <div>${e.message_text}</div>
                            `;

                            messagesEl.appendChild(wrapper);
                            scrollToBottom();
                        });
                }

                // Optional: prevent full page reload, do quick AJAX send
                messageForm.addEventListener('submit', function(event) {
                    // Let the normal POST + redirect work for now
                    // (simpler). If you want full SPA feel, we can
                    // switch this to axios and clear the input here.
                });

                scrollToBottom();
            });
        </script>
    @endpush
@endsection


