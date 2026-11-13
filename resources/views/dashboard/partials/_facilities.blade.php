@php
    $canManage = auth()->check() && (auth()->user()->hasRole('Administrator') || auth()->user()->hasPermission('facility.manage') || auth()->user()->hasPermission('facility.approve'));
    $isManageView = ($currentSection ?? '') === 'manage-facilities';
@endphp
<div class="page-header animate-fade-in-up">
    <div>
        <h1 class="page-title">{{ $isManageView ? 'Manage Facilities' : 'Campus Facilities' }}</h1>
        <p class="page-subtitle">{{ $isManageView ? 'Add, edit, update operational status, and manage campus venues and rooms.' : 'Browse and reserve campus venues and rooms.' }}</p>
    </div>
    <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
        @if($isManageView && $canManage)
            <a href="{{ url('/facilities/create') }}" class="btn btn-primary btn-sm">
                + Add Facility
            </a>
        @endif
        @if($isManageView)
            <a href="{{ url('/dashboard?section=manage-bookings') }}" class="btn btn-secondary btn-sm">
                Booking Requests
            </a>
        @else
            <a href="{{ url('/dashboard?section=booked-facilities') }}" class="btn btn-secondary btn-sm">
                My Booked Facilities
            </a>
        @endif
    </div>
</div>

@if(isset($myActiveReservations) && $myActiveReservations->isNotEmpty())
<div class="card animate-fade-in-up" style="animation-delay: 50ms; margin-bottom: 1rem; border-left: 4px solid var(--color-brand-500, #0ea5e9); background: rgba(14, 165, 233, 0.04);">
    <div class="card-body" style="display: flex; justify-content: space-between; align-items: center; padding: 0.85rem 1.25rem; flex-wrap: wrap; gap: .75rem;">
        <div>
            <strong>You have {{ $myActiveReservations->count() }} active facility reservation(s):</strong>
            <span class="text-muted" style="margin-left: .5rem; font-size: .85rem;">
                {{ $myActiveReservations->take(3)->map(fn($r) => $r->facility->name . ' (' . ucfirst($r->usage_state) . ')')->join(', ') }}
                @if($myActiveReservations->count() > 3) and more... @endif
            </span>
        </div>
        <a href="{{ url('/dashboard?section=booked-facilities') }}" class="btn btn-primary btn-sm" style="font-size: .8rem;">
            Manage Bookings &rarr;
        </a>
    </div>
</div>
@endif
<div class="card animate-fade-in-up" style="animation-delay: 100ms;">
    <div class="card-body">
        <form method="GET" action="{{ url('/dashboard') }}" class="search-bar" style="margin-bottom: 1rem;">
            <input type="hidden" name="section" value="{{ $currentSection ?? 'facilities' }}">
            <div class="search-input-wrapper">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" name="search" class="search-input" placeholder="Search facilities..." value="{{ $search }}">
            </div>
            <div class="filter-group">
                <a href="{{ url('/dashboard?section=' . ($currentSection ?? 'facilities')) }}" class="filter-btn {{ empty($statusFilter) ? 'active' : '' }}">All</a>
                <a href="{{ url('/dashboard?section=' . ($currentSection ?? 'facilities') . '&status=available') }}" class="filter-btn {{ ($statusFilter ?? '') === 'available' ? 'active' : '' }}">Available</a>
                <a href="{{ url('/dashboard?section=' . ($currentSection ?? 'facilities') . '&status=maintenance') }}" class="filter-btn {{ ($statusFilter ?? '') === 'maintenance' ? 'active' : '' }}">Maintenance</a>
                @if($isManageView && $canManage)
                    <a href="{{ url('/dashboard?section=' . ($currentSection ?? 'facilities') . '&status=unavailable') }}" class="filter-btn {{ ($statusFilter ?? '') === 'unavailable' ? 'active' : '' }}">Unavailable</a>
                @endif
            </div>
        </form>
        <div class="table-responsive manage-table-responsive">
            <table class="data-table mobile-cards">
                <thead>
                    <tr><th>Name</th><th>Location</th><th>Capacity</th><th>Status</th><th>Right Now</th><th>Action</th></tr>
                </thead>
                <tbody>
                @forelse($facilities as $f)
                    <tr>
                        <td data-label="Name" style="font-weight: 600;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                @if($f->image_url)
                                    <img src="{{ $f->image_url }}" alt="{{ $f->name }}" style="width: 42px; height: 42px; border-radius: 6px; object-fit: cover; border: 1px solid var(--color-border, #cbd5e1); flex-shrink: 0;" onerror="this.onerror=null; this.style.display='none';">
                                @else
                                    <div style="width: 42px; height: 42px; border-radius: 6px; background: rgba(14, 165, 233, 0.08); display: flex; align-items: center; justify-content: center; color: var(--color-brand-600, #0284c7); flex-shrink: 0;">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                                    </div>
                                @endif
                                <span>{{ $f->name }}</span>
                            </div>
                        </td>
                        <td data-label="Location">{{ $f->location }}</td>
                        <td data-label="Capacity">{{ $f->capacity }} person(s)</td>
                        <td data-label="Status">
                            <x-status-badge :status="$f->status" />
                        </td>
                        <td data-label="Right Now">
                            @php $occ = $occupiedMap[$f->id] ?? null; @endphp
                            @if($f->status !== 'available')
                                <span class="text-muted">—</span>
                            @elseif($occ)
                                <span class="badge badge-error"><span class="occupancy-dot occupied"></span>Occupied</span>
                                <div class="text-muted" style="font-size: .75rem; margin-top: .2rem;">Until {{ $occ->ends_at->format('g:i A') }}</div>
                            @else
                                <span class="badge badge-success"><span class="occupancy-dot"></span>Open</span>
                            @endif
                        </td>
                        <td data-label="Action" class="card-actions-cell">
                            <div style="display: flex; gap: 0.35rem; align-items: center; flex-wrap: wrap;">
                                <a href="{{ url('/facilities/' . $f->id) }}" class="btn btn-secondary btn-sm" style="font-size: 0.75rem;">View</a>
                                @if($isManageView && $canManage)
                                    <a href="{{ url('/facilities/' . $f->id . '/edit') }}" class="btn btn-primary btn-sm" style="font-size: 0.75rem;">Edit</a>
                                    <form method="POST" action="{{ url('/facilities/' . $f->id) }}" style="margin: 0; display: inline;" onsubmit="return confirm('Are you sure you want to delete &quot;{{ $f->name }}&quot;?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="font-size: 0.75rem; color: #dc2626; background: rgba(239, 68, 68, 0.08); border: 1px solid rgba(239, 68, 68, 0.2);">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted" style="padding: 2rem 1rem;">
                            <p style="margin-bottom: .5rem;">No facilities found.</p>
                            @if(request('search'))
                                <a href="{{ url('/dashboard?section=facilities') }}" class="btn btn-secondary btn-sm">Clear Search</a>
                            @endif
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $facilities->withQueryString()->links('partials.pagination') }}
    </div>
</div>
