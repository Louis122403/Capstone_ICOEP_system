@extends('layouts.app')
@section('title', $pageTitle . ' — ' . config('icoep.app_name'))

@section('content')
<div class="page-header animate-fade-in-up">
    <div>
        <h1 class="page-title">Edit: {{ $facility->name }}</h1>
        <p class="page-subtitle">Update venue details, capacity, and operational status.</p>
    </div>
    <div style="display: flex; gap: 0.5rem; align-items: center;">
        <a href="{{ url('/facilities/' . $facility->id) }}" class="btn btn-secondary">&larr; View Details</a>
        <a href="{{ url('/dashboard?section=manage-facilities') }}" class="btn btn-secondary">Manage Facilities</a>
    </div>
</div>

<div class="card animate-fade-in-up" style="animation-delay: 100ms;">
    <div class="card-body">
        <form method="POST" action="{{ url('/facilities/' . $facility->id) }}" enctype="multipart/form-data" class="form-grid">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="name">Facility Name *</label>
                <input type="text" id="name" name="name" class="form-control @error('name') error @enderror"
                       value="{{ old('name', $facility->name) }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="location">Location</label>
                <input type="text" id="location" name="location" class="form-control @error('location') error @enderror"
                       value="{{ old('location', $facility->location) }}" placeholder="e.g., Admin Building, 2nd Floor">
                @error('location') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="capacity">Capacity (Persons) *</label>
                <input type="number" id="capacity" name="capacity" class="form-control @error('capacity') error @enderror"
                       value="{{ old('capacity', $facility->capacity) }}" min="1" required>
                @error('capacity') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="status">Operational Status *</label>
                <select id="status" name="status" class="form-select @error('status') error @enderror" required>
                    <option value="available" {{ old('status', $facility->status) === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="maintenance" {{ old('status', $facility->status) === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="unavailable" {{ old('status', $facility->status) === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
                @error('status') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label" for="description">Description</label>
                <textarea id="description" name="description" class="form-control @error('description') error @enderror" rows="3">{{ old('description', $facility->description) }}</textarea>
                @error('description') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label" for="image">Change Facility Photo (Optional)</label>
                @if($facility->image_url)
                    <div style="margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                        <img src="{{ $facility->image_url }}" alt="{{ $facility->name }}" style="height: 60px; width: 80px; object-fit: cover; border-radius: 6px; border: 1px solid var(--color-border, #cbd5e1);">
                        <span class="text-muted" style="font-size: 0.8rem;">Current photo uploaded</span>
                    </div>
                @endif
                <input type="file" id="image" name="image" class="form-control @error('image') error @enderror" accept="image/*">
                @error('image') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div style="grid-column: 1 / -1; display: flex; gap: 0.75rem; justify-content: flex-end; margin-top: 1rem;">
                <a href="{{ url('/facilities/' . $facility->id) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection

