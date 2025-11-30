@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h2 class="mb-3">Chat Rooms</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <h5>Your Rooms</h5>
            <ul class="list-group mb-4">
                @forelse ($myRooms as $room)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $room->room_name }}</strong>
                            <div class="small text-muted">
                                {{ $room->description }}
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('chat.rooms.show', $room) }}" class="btn btn-sm btn-red">Open</a>
                            <form action="{{ route('chat.rooms.leave', $room) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-outline-red">Leave</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item">You haven’t joined any rooms yet.</li>
                @endforelse
            </ul>

            <h5>Public Rooms</h5>
            <ul class="list-group">
                @forelse ($publicRooms as $room)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $room->room_name }}</strong>
                            <span class="badge ms-2" style="background-color: #dc143c; color: white;">Public</span>
                            <div class="small text-muted">
                                {{ $room->description }}
                            </div>
                        </div>
                        <form action="{{ route('chat.rooms.join', $room) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-outline-red">Join</button>
                        </form>
                    </li>
                @empty
                    <li class="list-group-item">No public rooms yet. Create one!</li>
                @endforelse
            </ul>
        </div>

        <div class="col-md-4">
            <h4 class="mb-3">Create a Room</h4>

            <form action="{{ route('chat.rooms.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Room Name</label>
                    <input type="text" name="room_name" class="form-control" value="{{ old('room_name') }}" required>
                    @error('room_name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select">
                        <option value="public" {{ old('type') === 'private' ? '' : 'selected' }}>Public</option>
                        <option value="private" {{ old('type') === 'private' ? 'selected' : '' }}>Private</option>
                    </select>
                    @error('type')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="invite_permission" id="invite_permission"
                        value="1" {{ old('invite_permission', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="invite_permission">
                        Allow members to invite others
                    </label>
                </div>

                <button class="btn btn-red w-100" type="submit">Create Room</button>
            </form>
        </div>
    </div>
@endsection
