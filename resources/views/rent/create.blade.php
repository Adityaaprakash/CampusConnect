@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="mb-3">Add New Property</h3>
                    <p class="text-muted">Fill the details below to list your room/PG/flat.</p>

                    <form action="{{ route('rent.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                placeholder="e.g. 2BHK Near Gate 2" required>
                            @error('title')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rent per month (₹)</label>
                                <input type="number" name="rent" class="form-control" value="{{ old('rent') }}"
                                    required>
                                @error('rent')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Deposit (optional)</label>
                                <input type="number" name="deposit" class="form-control" value="{{ old('deposit') }}">
                                @error('deposit')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location (short)</label>
                            <input type="text" name="location" class="form-control"
                                placeholder="e.g. Near Gate 2, College Road" value="{{ old('location') }}" required>
                            @error('location')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Full Address (optional)</label>
                            <textarea name="full_address" class="form-control" rows="2">{{ old('full_address') }}</textarea>
                            @error('full_address')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Amenities (comma separated)</label>
                            <input type="text" name="amenities" class="form-control"
                                placeholder="Wi-Fi, Food, AC, Laundry" value="{{ old('amenities') }}">
                            @error('amenities')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4"
                                placeholder="Describe the room, nearby facilities, rules, etc.">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Owner / Agent Name</label>
                                <input type="text" name="owner_name" class="form-control"
                                    value="{{ old('owner_name', auth()->user()->name) }}" required>
                                @error('owner_name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Availability Status</label>
                            <select name="availability_status" class="form-select">
                                <option value="available" {{ old('availability_status') === 'available' ? 'selected' : '' }}>
                                    Available
                                </option>
                                <option value="occupied" {{ old('availability_status') === 'occupied' ? 'selected' : '' }}>
                                    Occupied
                                </option>
                                <option value="upcoming" {{ old('availability_status') === 'upcoming' ? 'selected' : '' }}>
                                    Upcoming
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Property Images (you can select multiple)</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                            @error('images.*')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-red w-100">
                            Submit Listing
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


