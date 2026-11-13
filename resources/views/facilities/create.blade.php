@extends('layouts.app')
@section('title', $pageTitle . ' — ' . config('icoep.app_name'))

@section('content')
<div class="page-header animate-fade-in-up">
    <div>
        <h1 class="page-title">Add Facility</h1>
        <p class="page-subtitle">Add a new campus venue, room, or facility available for reservation.</p>
    </div>
    <a href="{{ url('/dashboard?section=manage-facilities') }}" class="btn btn-secondary">&larr; Back to Manage Facilities</a>
</div>

<div class="card animate-fade-in-up" style="animation-delay: 100ms;">
    <div class="card-body">
        <form method="POST" action="{{ url('/facilities') }}" enctype="multipart/form-data" class="form-grid">
            @csrf

            <div class="form-group">
                <label class="form-label" for="name">Facility Name *</label>
                <input type="text" id="name" name="name" class="form-control @error('name') error @enderror"
                       value="{{ old('name') }}" placeholder="e.g., University Auditorium" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="location">Location</label>
                <input type="text" id="location" name="location" class="form-control @error('location') error @enderror"
                       value="{{ old('location') }}" placeholder="e.g., Admin Building, 2nd Floor">
                @error('location') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="capacity">Capacity (Persons) *</label>
                <input type="number" id="capacity" name="capacity" class="form-control @error('capacity') error @enderror"
                       value="{{ old('capacity', 50) }}" min="1" required>
                @error('capacity') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="status">Initial Status *</label>
                <select id="status" name="status" class="form-select @error('status') error @enderror" required>
                    <option value="available" {{ old('status', 'available') === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="unavailable" {{ old('status') === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
                @error('status') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label" for="description">Description</label>
                <textarea id="description" name="description" class="form-control @error('description') error @enderror" rows="3"
                          placeholder="Brief description of the facility and features...">{{ old('description') }}</textarea>
                @error('description') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label" for="image">Facility Photo / Image (Optional)</label>
                <input type="file" id="image" name="image" class="form-control @error('image') error @enderror" accept="image/*">
                @error('image') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div style="grid-column: 1 / -1; display: flex; gap: 0.75rem; justify-content: flex-end; margin-top: 1rem;">
                <a href="{{ url('/dashboard?section=manage-facilities') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Add Facility</button>
            </div>
        </form>
    </div>
</div>
@endsection

