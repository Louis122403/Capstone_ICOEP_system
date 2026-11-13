@extends('layouts.app')

@section('title', $pageTitle . ' — ' . config('icoep.app_name'))

@section('content')
<div class="user-guide-wrapper">
    {{-- Header --}}
    <div class="page-header animate-fade-in-up" style="margin-bottom: 1.5rem;">
        <div>
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                <span class="badge badge-brand" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">System Documentation</span>
                <span class="text-muted" style="font-size: 0.8rem;">v{{ config('icoep.app_version') }}</span>
            </div>
            <h1 class="page-title" style="font-size: 1.85rem; font-weight: 800; display: flex; align-items: center; gap: 0.6rem;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-brand-500, #0ea5e9);">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
                ICOEP User Guide &amp; System Manual
            </h1>
            <p class="page-subtitle" style="font-size: 0.95rem; max-width: 800px;">
                Complete step-by-step walkthrough for reserving campus facilities, borrowing equipment, tracking returns, and managing daily campus operations at {{ config('icoep.institution_name') }}.
            </p>
        </div>
        <div style="display: flex; gap: 0.6rem; align-items: center; flex-wrap: wrap;">
            <button type="button" onclick="window.print()" class="btn btn-secondary btn-sm" style="display: inline-flex; align-items: center; gap: 0.4rem;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                Print / Save PDF
            </button>
            <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-sm">&larr; Back to Dashboard</a>
        </div>
    </div>

    {{-- Search & Quick Jump Bar --}}
    <div class="card animate-fade-in-up" style="animation-delay: 50ms; margin-bottom: 1.5rem; background: var(--color-bg-card); border-left: 4px solid var(--color-brand-500, #0ea5e9);">
        <div class="card-body" style="padding: 1rem 1.25rem;">
            <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                <div class="search-input-wrapper" style="flex: 1; min-width: 260px; margin: 0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" id="guideSearchInput" class="search-input" placeholder="Search guide topics (e.g., return equipment, facility booking, QR scanner)..." onkeyup="filterGuideTopics()">
                </div>
                <div style="display: flex; gap: 0.4rem; align-items: center; flex-wrap: wrap; font-size: 0.82rem;">
                    <span class="text-muted">Jump to:</span>
                    <a href="#facilities" class="guide-quick-pill">Facilities</a>
                    <a href="#equipment-borrowing" class="guide-quick-pill">Borrowing</a>
                    <a href="#equipment-returns" class="guide-quick-pill">Returns &amp; Photo</a>
                    <a href="#management" class="guide-quick-pill">Management</a>
                    <a href="#events" class="guide-quick-pill">Events</a>
                    <a href="#faq" class="guide-quick-pill">FAQs</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Guide Layout --}}
    <div class="guide-layout">
        {{-- Sticky Navigation Sidebar --}}
        <aside class="guide-nav-sidebar">
            <div class="guide-nav-card card">
                <h4 style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted); margin-bottom: 0.85rem; padding-bottom: 0.5rem; border-bottom: 1px solid var(--color-border);">
                    Table of Contents
                </h4>
                <nav class="guide-toc">
                    <a href="#overview" class="guide-toc-link active" onclick="activateToc(this)">
                        <span class="toc-num">1</span>
                        <span>System Overview &amp; Roles</span>
                    </a>
                    <a href="#facilities" class="guide-toc-link" onclick="activateToc(this)">
                        <span class="toc-num">2</span>
                        <span>Facility Reservations</span>
                    </a>
                    <a href="#equipment-borrowing" class="guide-toc-link" onclick="activateToc(this)">
                        <span class="toc-num">3</span>
                        <span>Equipment Borrowing</span>
                    </a>
                    <a href="#equipment-returns" class="guide-toc-link" onclick="activateToc(this)">
                        <span class="toc-num">4</span>
                        <span>Returns &amp; Photo Proof</span>
                    </a>
                    <a href="#management" class="guide-toc-link" onclick="activateToc(this)">
                        <span class="toc-num">5</span>
                        <span>Management Workflows</span>
                    </a>
                    <a href="#events-announcements" class="guide-toc-link" onclick="activateToc(this)">
                        <span class="toc-num">6</span>
                        <span>Events &amp; Announcements</span>
                    </a>
                    <a href="#account-security" class="guide-toc-link" onclick="activateToc(this)">
                        <span class="toc-num">7</span>
                        <span>Profile &amp; Inactivity Policy</span>
                    </a>
                    <a href="#faq" class="guide-toc-link" onclick="activateToc(this)">
                        <span class="toc-num">8</span>
                        <span>FAQs &amp; Troubleshooting</span>
                    </a>
                </nav>
            </div>
        </aside>

        {{-- Guide Content Sections --}}
        <div class="guide-content-area">

            {{-- 1. System Overview --}}
            <section id="overview" class="guide-section card animate-fade-in-up">
                <div class="card-header">
                    <h2 class="guide-section-title">
                        <span class="guide-num">1</span>
                        System Overview &amp; User Roles
                    </h2>
                </div>
                <div class="card-body guide-body">
                    <p>
                        The <strong>Integrated Campus Operations and Engagement Portal (ICOEP)</strong> is a centralized web platform designed for <strong>{{ config('icoep.institution_name') }} ({{ config('icoep.institution_short') }})</strong>. It unifies venue scheduling, inventory circulation, student/faculty engagement, and automated administrative operations into one synchronized system.
                    </p>

                    <h3 class="guide-subtitle">User Roles &amp; Permissions</h3>
                    <div class="grid grid-2" style="gap: 1rem; margin-top: 0.75rem;">
                        <div class="guide-role-card">
                            <div class="guide-role-header">
                                <span class="badge badge-brand">Student</span>
                            </div>
                            <p style="font-size: 0.85rem; color: var(--color-text-secondary); margin: 0;">
                                Can browse available facilities, book venues for presentations/activities, borrow equipment for academic work, upload return photos, and register for campus events.
                            </p>
                        </div>
                        <div class="guide-role-card">
                            <div class="guide-role-header">
                                <span class="badge badge-success">Faculty &amp; Staff</span>
                            </div>
                            <p style="font-size: 0.85rem; color: var(--color-text-secondary); margin: 0;">
                                Higher priority for facility reservations, can borrow specialized instructional equipment, organize department events, and post institutional announcements.
                            </p>
                        </div>
                        <div class="guide-role-card">
                            <div class="guide-role-header">
                                <span class="badge badge-warning">Custodian / Unit Staff</span>
                            </div>
                            <p style="font-size: 0.85rem; color: var(--color-text-secondary); margin: 0;">
                                Manages their assigned custodian unit's inventory, operates the pickup release queue, inspects returned equipment, and verifies return photo evidence.
                            </p>
                        </div>
                        <div class="guide-role-card">
                            <div class="guide-role-header">
                                <span class="badge badge-error">System Administrator</span>
                            </div>
                            <p style="font-size: 0.85rem; color: var(--color-text-secondary); margin: 0;">
                                Full operational access: adds, edits, and deletes facilities in <em>Manage Facilities</em>, approves/rejects requests, manages user accounts, and monitors audit logs.
                            </p>
                        </div>
                    </div>

                    <div class="guide-callout info" style="margin-top: 1.25rem;">
                        <div class="guide-callout-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        </div>
                        <div>
                            <strong>Unified Navigation Bar &amp; Dark Mode:</strong>
                            You can switch between Light and Dark themes anytime using the sun/moon toggle button in the top navigation bar. Notifications with real-time badges appear in the Bell icon.
                        </div>
                    </div>
                </div>
            </section>

            {{-- 2. Facility Reservations --}}
            <section id="facilities" class="guide-section card animate-fade-in-up">
                <div class="card-header">
                    <h2 class="guide-section-title">
                        <span class="guide-num">2</span>
                        Campus Facilities &amp; Reservations
                    </h2>
                </div>
                <div class="card-body guide-body">
                    <p>
                        The <strong>Campus Facilities</strong> section (under <em>OPERATIONS &rarr; Facilities</em>) allows all students, faculty, and staff to browse campus venues and submit reservation requests.
                    </p>

                    <h3 class="guide-subtitle">How to Reserve a Facility</h3>
                    <div class="guide-steps">
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 1</div>
                            <div class="guide-step-content">
                                <strong>Browse Campus Venues:</strong> Go to <em>Facilities</em> in the sidebar. You can view facility photos, location, capacity, and real-time operational status (e.g., <span class="badge badge-success" style="font-size: 0.7rem;">Open now</span> or <span class="badge badge-error" style="font-size: 0.7rem;">Occupied until 4:00 PM</span>).
                            </div>
                        </div>
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 2</div>
                            <div class="guide-step-content">
                                <strong>Select a Venue:</strong> Click the <strong>View</strong> button on any facility (such as AVR, Auditorium, or Conference Room) to open its details page.
                            </div>
                        </div>
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 3</div>
                            <div class="guide-step-content">
                                <strong>Fill Out the Reservation Form:</strong> In the sidebar form on the facility page:
                                <ul style="margin: 0.35rem 0 0 1.25rem; font-size: 0.88rem;">
                                    <li><strong>Reservation Date:</strong> The day you need the venue.</li>
                                    <li><strong>Start Time &amp; End Time:</strong> The exact reservation window (must be within campus operating hours).</li>
                                    <li><strong>Purpose:</strong> A clear description of the activity (e.g., "Class project presentation" or "Department assembly").</li>
                                </ul>
                            </div>
                        </div>
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 4</div>
                            <div class="guide-step-content">
                                <strong>Automatic Conflict Check &amp; Submission:</strong> Click <strong>Submit Reservation</strong>.
                                <ul style="margin: 0.35rem 0 0 1.25rem; font-size: 0.88rem;">
                                    <li><strong>Auto-Approval Engine:</strong> If there is no time conflict and the request falls within operating hours, the system may approve it automatically!</li>
                                    <li><strong>Conflict Detection:</strong> If another group already booked the same time slot, the system will block the overlap and suggest alternative open time slots.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="guide-callout warning" style="margin-top: 1rem;">
                        <div class="guide-callout-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        </div>
                        <div>
                            <strong>Priority &amp; Preemption Rule:</strong>
                            Student bookings can be preempted by higher priority institutional events (Faculty or Administration) provided there is at least 24 hours notice. If preempted, you will receive an immediate notification with alternative venue suggestions.
                        </div>
                    </div>

                    <h3 class="guide-subtitle" style="margin-top: 1.25rem;">Tracking Your Reservations</h3>
                    <p>
                        Click <strong>Booked Facilities</strong> in the sidebar (or <em>My Booked Facilities</em>) to review your active, upcoming, and past reservations. You can cancel any pending or upcoming reservation if your plans change.
                    </p>
                </div>
            </section>

            {{-- 3. Equipment Borrowing --}}
            <section id="equipment-borrowing" class="guide-section card animate-fade-in-up">
                <div class="card-header">
                    <h2 class="guide-section-title">
                        <span class="guide-num">3</span>
                        Equipment Borrowing
                    </h2>
                </div>
                <div class="card-body guide-body">
                    <p>
                        Authorized users can request school equipment (projectors, audio systems, laboratory tools, sports gear) through the <strong>Equipment</strong> catalog.
                    </p>

                    <h3 class="guide-subtitle">How to Request Equipment</h3>
                    <div class="guide-steps">
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 1</div>
                            <div class="guide-step-content">
                                <strong>Find Item in Catalog:</strong> Navigate to <em>Operations &rarr; Equipment</em>. Filter by category (Audio-Visual, Laboratory, Sports, Electronics) or search by item name.
                            </div>
                        </div>
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 2</div>
                            <div class="guide-step-content">
                                <strong>Check Available Units:</strong> Each equipment card displays real-time available stock (e.g. <code>3/4 available</code>). Click on the item to open its request page.
                            </div>
                        </div>
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 3</div>
                            <div class="guide-step-content">
                                <strong>Specify Quantity, Dates &amp; Times:</strong>
                                <ul style="margin: 0.35rem 0 0 1.25rem; font-size: 0.88rem;">
                                    <li><strong>Quantity:</strong> Number of units required (cannot exceed available stock).</li>
                                    <li><strong>Purpose:</strong> Reason for borrowing (e.g., "Research presentation in Room 201").</li>
                                    <li><strong>Date Needed &amp; Time Needed:</strong> The exact date and time you will pick up the item.</li>
                                    <li><strong>Expected Return Date &amp; Expected Return Time:</strong> When the item will be returned to the custodian.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 4</div>
                            <div class="guide-step-content">
                                <strong>Submit &amp; Await Approval:</strong> Click <strong>Submit Request</strong>. An administrator or equipment custodian will review your request. You will receive an alert once approved.
                            </div>
                        </div>
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 5</div>
                            <div class="guide-step-content">
                                <strong>Pickup from Custodian:</strong> Once approved, proceed to the custodian desk during your scheduled pickup time to receive the item.
                            </div>
                        </div>
                    </div>

                    <div class="guide-callout error" style="margin-top: 1rem;">
                        <div class="guide-callout-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                        </div>
                        <div>
                            <strong>Overdue Borrowing Restriction:</strong>
                            If an account has any borrowed item that is <strong>3 or more days overdue</strong>, borrowing privileges are automatically locked. You will not be permitted to submit new equipment requests until all overdue items are returned and cleared.
                        </div>
                    </div>
                </div>
            </section>

            {{-- 4. Returns & Photo Proof --}}
            <section id="equipment-returns" class="guide-section card animate-fade-in-up">
                <div class="card-header">
                    <h2 class="guide-section-title">
                        <span class="guide-num">4</span>
                        Equipment Returns &amp; Photo Proof
                    </h2>
                </div>
                <div class="card-body guide-body">
                    <p>
                        To ensure accountability and prevent disputes regarding item condition, the system incorporates a <strong>mandatory photographic return workflow</strong>.
                    </p>

                    <h3 class="guide-subtitle">Borrower Return Workflow</h3>
                    <div class="guide-steps">
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 1</div>
                            <div class="guide-step-content">
                                <strong>Go to Borrowed Equipment:</strong> Open <em>Operations &rarr; Borrowed Equipment</em> from the sidebar to view all items currently in your possession.
                            </div>
                        </div>
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 2</div>
                            <div class="guide-step-content">
                                <strong>Click "Request Return":</strong> On the borrowed item row, click the <strong>Request Return</strong> action button.
                            </div>
                        </div>
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 3</div>
                            <div class="guide-step-content">
                                <strong>Select Condition &amp; Upload Photo Proof:</strong>
                                <ul style="margin: 0.35rem 0 0 1.25rem; font-size: 0.88rem;">
                                    <li><strong>Condition:</strong> Choose whether the item is in <em>Good</em>, <em>Fair</em>, <em>Needs Repair</em>, or <em>Damaged</em> condition.</li>
                                    <li><strong>Remarks:</strong> Add any notes regarding missing accessories or issues encountered during use.</li>
                                    <li><strong>Photo Proof (Mandatory):</strong> Take or upload a clear photo showing the item's physical state. Supports camera capture on mobile devices!</li>
                                </ul>
                            </div>
                        </div>
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 4</div>
                            <div class="guide-step-content">
                                <strong>Physical Handover:</strong> Hand the equipment to the designated custodian or laboratory in-charge. The custodian will verify the physical item against your uploaded photo.
                            </div>
                        </div>
                        <div class="guide-step-item">
                            <div class="guide-step-badge">Step 5</div>
                            <div class="guide-step-content">
                                <strong>Return Processed:</strong> The custodian clicks <strong>Process Return</strong> at the Returns Desk. Your borrow record is marked as <code>Returned</code> and inventory stock is automatically replenished.
                            </div>
                        </div>
                    </div>

                    <div class="guide-callout info" style="margin-top: 1rem;">
                        <div class="guide-callout-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                        </div>
                        <div>
                            <strong>Photo Upload Tip:</strong>
                            Make sure the photo clearly shows the equipment body, cables, and accessories. Accepted formats include JPG and PNG under 2MB.
                        </div>
                    </div>
                </div>
            </section>

            {{-- 5. Management Workflows --}}
            <section id="management" class="guide-section card animate-fade-in-up">
                <div class="card-header">
                    <h2 class="guide-section-title">
                        <span class="guide-num">5</span>
                        Administrative &amp; Custodian Workflows
                    </h2>
                </div>
                <div class="card-body guide-body">
                    <p>
                        Authorized staff, custodians, and administrators have access to the <strong>MANAGEMENT</strong> tools in the sidebar to oversee campus logistics.
                    </p>

                    <h3 class="guide-subtitle">1. Manage Facilities (Admin Only)</h3>
                    <p style="font-size: 0.9rem;">
                        Located at <em>MANAGEMENT &rarr; Manage Facilities</em> (distinct from the public browsing page):
                    </p>
                    <ul style="margin: 0.25rem 0 0.75rem 1.25rem; font-size: 0.88rem;">
                        <li><strong>+ Add Facility:</strong> Add new campus venues with room name, location, capacity, status, description, and venue photo.</li>
                        <li><strong>Edit Facility:</strong> Update capacity, location, description, or change operational status to <em>Available</em>, <em>Maintenance</em>, or <em>Unavailable</em>.</li>
                        <li><strong>Delete Facility:</strong> Safe deletion with built-in protection: venues cannot be deleted if active or pending bookings exist.</li>
                    </ul>

                    <h3 class="guide-subtitle" style="margin-top: 1.25rem;">2. Booking Requests Review</h3>
                    <p style="font-size: 0.9rem;">
                        Located at <em>MANAGEMENT &rarr; Booking Requests</em>:
                    </p>
                    <ul style="margin: 0.25rem 0 0.75rem 1.25rem; font-size: 0.88rem;">
                        <li>Review pending venue reservations from students and departments.</li>
                        <li>The system automatically highlights conflict warnings if another booking overlaps.</li>
                        <li>Single-click <strong>Approve</strong> or <strong>Reject</strong> with administrative remarks.</li>
                    </ul>

                    <h3 class="guide-subtitle" style="margin-top: 1.25rem;">3. Equipment Requests &amp; Pickup Queue</h3>
                    <p style="font-size: 0.9rem;">
                        Located at <em>MANAGEMENT &rarr; Equipment Requests</em> and <em>Pickup Queue</em>:
                    </p>
                    <ul style="margin: 0.25rem 0 0.75rem 1.25rem; font-size: 0.88rem;">
                        <li><strong>Approve Requests:</strong> Authorize borrowers to borrow requested quantities.</li>
                        <li><strong>Pickup Queue:</strong> When the borrower arrives at the counter, the custodian marks the item as <em>Released / Borrowed</em>, starting the active borrow timer.</li>
                    </ul>

                    <h3 class="guide-subtitle" style="margin-top: 1.25rem;">4. Equipment Returns Desk</h3>
                    <p style="font-size: 0.9rem;">
                        Located at <em>MANAGEMENT &rarr; Equipment Returns</em>:
                    </p>
                    <ul style="margin: 0.25rem 0 0.75rem 1.25rem; font-size: 0.88rem;">
                        <li><strong>Filter Tabs:</strong> Segmented controls for <em>Active Borrows</em>, <em>Needs Check</em> (returns with uploaded photo pending inspection), <em>Overdue</em>, <em>Due Today</em>, and <em>Recently Returned</em>.</li>
                        <li><strong>Barcode / Scanner Input:</strong> Supports USB or Bluetooth barcode/QR scanners to instantly lookup requests.</li>
                        <li><strong>Process Return:</strong> Verify item condition, view borrower's uploaded photo proof, assess any missing/damaged parts, and complete return clearance.</li>
                    </ul>

                    <h3 class="guide-subtitle" style="margin-top: 1.25rem;">5. Reports &amp; Analytics</h3>
                    <p style="font-size: 0.9rem;">
                        Located at <em>Reports &amp; Analytics</em> in the sidebar:
                    </p>
                    <ul style="margin: 0.25rem 0 0.75rem 1.25rem; font-size: 0.88rem;">
                        <li><strong>Facility Usage:</strong> Frequency of room usage, peak reservation hours, and department distribution.</li>
                        <li><strong>Equipment Usage:</strong> Volume of borrow requests, approval rates, total units circulated, and return statistics per equipment item.</li>
                        <li><strong>Event Engagement:</strong> Registration counts, capacity fill rates, and audience turnout per campus event.</li>
                        <li><strong>Audit Trail:</strong> Immutable security log tracking all logins, approvals, updates, and cancellations.</li>
                    </ul>

                    <h3 class="guide-subtitle" style="margin-top: 1.25rem;">6. Data Backup &amp; Disaster Recovery (Admin Only)</h3>
                    <p style="font-size: 0.9rem;">
                        Located at <em>MANAGEMENT &rarr; Data Backup</em>:
                    </p>
                    <ul style="margin: 0.25rem 0 0.75rem 1.25rem; font-size: 0.88rem;">
                        <li><strong>Create Backup:</strong> Generates a full snapshot of all campus databases (users, facilities, equipment, reservations, borrows, events, logs) in standard SQL format.</li>
                        <li><strong>Disaster Recovery:</strong> In case of power blackouts, internet outages, or cloud disruptions, administrators can download backups locally to guarantee zero data loss.</li>
                        <li><strong>Manage Backups:</strong> Download backups to secure external storage or delete obsolete archives to manage disk space.</li>
                    </ul>
                </div>
            </section>

            {{-- 6. Events & Announcements --}}
            <section id="events-announcements" class="guide-section card animate-fade-in-up">
                <div class="card-header">
                    <h2 class="guide-section-title">
                        <span class="guide-num">6</span>
                        Campus Events &amp; Announcements
                    </h2>
                </div>
                <div class="card-body guide-body">
                    <h3 class="guide-subtitle">Campus Events &amp; QR Attendance</h3>
                    <p>
                        Under <em>ENGAGEMENT &rarr; Events</em>, users can view upcoming institution activities, seminars, sports meets, and student assemblies.
                    </p>
                    <ul style="margin: 0.25rem 0 0.75rem 1.25rem; font-size: 0.88rem;">
                        <li><strong>Event Registration:</strong> Click <strong>Register</strong> on any open event to secure a slot.</li>
                        <li><strong>Target Audience:</strong> Events can be targeted to specific departments (e.g. BSIT, BSED, Senior High) or open to all.</li>
                        <li><strong>QR Attendance Check-in:</strong> Organizers can use the built-in <strong>QR Scanner</strong> to scan participant badges or use the manual check-in roster.</li>
                    </ul>

                    <h3 class="guide-subtitle" style="margin-top: 1.25rem;">Announcements &amp; Bulletins</h3>
                    <p>
                        Under <em>ENGAGEMENT &rarr; Announcements</em>, important campus memorandums, holiday announcements, and emergency notices are posted:
                    </p>
                    <ul style="margin: 0.25rem 0 0.75rem 1.25rem; font-size: 0.88rem;">
                        <li><strong>Pinned Notices:</strong> Priority bulletins stay highlighted at the top of the feed.</li>
                        <li><strong>Expiration Date:</strong> Time-sensitive notices automatically archive once their expiration date passes.</li>
                    </ul>
                </div>
            </section>

            {{-- 7. Profile & Account Inactivity Policy --}}
            <section id="account-security" class="guide-section card animate-fade-in-up">
                <div class="card-header">
                    <h2 class="guide-section-title">
                        <span class="guide-num">7</span>
                        Account Profile &amp; Inactivity Policy
                    </h2>
                </div>
                <div class="card-body guide-body">
                    <h3 class="guide-subtitle">Managing Your Profile</h3>
                    <p>
                        Click your user avatar in the top-right navigation bar and select <strong>My Profile</strong>. Here you can:
                    </p>
                    <ul style="margin: 0.25rem 0 0.75rem 1.25rem; font-size: 0.88rem;">
                        <li>Update your contact number and department details.</li>
                        <li>Change your password securely (requires minimum 8 characters).</li>
                        <li>View your active role assignments and permission scope.</li>
                    </ul>

                    <h3 class="guide-subtitle" style="margin-top: 1.25rem;">Automated Inactivity Protection</h3>
                    <p>
                        In accordance with institutional security guidelines:
                    </p>
                    <div class="guide-callout warning">
                        <div class="guide-callout-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </div>
                        <div>
                            <strong>14-Day Inactivity Deactivation:</strong>
                            Accounts with no login activity for <strong>14 consecutive days</strong> are automatically deactivated to prevent unauthorized access.
                            <br><br>
                            <strong>Safeguard:</strong> The system automatically protects you from deactivation if you have active borrowed equipment or an upcoming facility booking! A warning notification is sent 2 days prior to any pending deactivation.
                        </div>
                    </div>
                </div>
            </section>

            {{-- 8. FAQ & Troubleshooting --}}
            <section id="faq" class="guide-section card animate-fade-in-up">
                <div class="card-header">
                    <h2 class="guide-section-title">
                        <span class="guide-num">8</span>
                        Frequently Asked Questions (FAQs)
                    </h2>
                </div>
                <div class="card-body guide-body">
                    <div class="guide-faq-list">
                        <details class="guide-faq-item">
                            <summary class="guide-faq-question">
                                <span>Why did my facility booking get rejected or show a conflict?</span>
                                <svg class="faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </summary>
                            <div class="guide-faq-answer">
                                Another user or department has already booked that facility for the same date and overlapping hours. When a conflict occurs, the system provides alternative available times or dates. You can also choose another similar venue.
                            </div>
                        </details>

                        <details class="guide-faq-item">
                            <summary class="guide-faq-question">
                                <span>Why is the "Submit Request" button disabled or showing an overdue warning?</span>
                                <svg class="faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </summary>
                            <div class="guide-faq-answer">
                                Institutional policy blocks new equipment borrowing if you currently have an item that is 3 or more days overdue. Please submit your return request with photo proof in <em>Borrowed Equipment</em> and return the item to the custodian desk to restore your account.
                            </div>
                        </details>

                        <details class="guide-faq-item">
                            <summary class="guide-faq-question">
                                <span>What should I do if my return photo fails to upload?</span>
                                <svg class="faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </summary>
                            <div class="guide-faq-answer">
                                Ensure your image is a standard JPG or PNG file under 2MB in size. On smartphones, you can take a photo directly through the browser prompt. If your connection is unstable, try refreshing the page or switching to a smaller photo resolution.
                            </div>
                        </details>

                        <details class="guide-faq-item">
                            <summary class="guide-faq-question">
                                <span>Where do I find "Manage Facilities" to add or edit venues?</span>
                                <svg class="faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </summary>
                            <div class="guide-faq-answer">
                                "Manage Facilities" is reserved for Administrators and Facilities Managers. It is located under the <strong>MANAGEMENT</strong> section of the sidebar navigation. The public <em>Facilities</em> page under <strong>OPERATIONS</strong> is strictly for browsing and booking.
                            </div>
                        </details>

                        <details class="guide-faq-item">
                            <summary class="guide-faq-question">
                                <span>Who do I contact if my account is locked or deactivated?</span>
                                <svg class="faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </summary>
                            <div class="guide-faq-answer">
                                Contact the System Administrator or the MIS / Administration Office of {{ config('icoep.institution_name') }}. An administrator can reactivate your account in <em>User Management</em>.
                            </div>
                        </details>
                    </div>

                    <div style="margin-top: 2rem; padding: 1.5rem; background: var(--color-bg-surface, #f8fafc); border: 1px solid var(--color-border); border-radius: var(--radius-md); text-align: center;">
                        <h4 style="margin: 0 0 0.5rem 0; font-size: 1rem;">Need Additional Assistance?</h4>
                        <p class="text-muted" style="margin: 0 0 1rem 0; font-size: 0.88rem;">
                            For technical inquiries, policy clarifications, or account assistance, please visit the Administration Office.
                        </p>
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-sm">Return to Dashboard</a>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<style>
/* User Guide Specific Styles */
.user-guide-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.guide-quick-pill {
    display: inline-block;
    padding: 0.25rem 0.65rem;
    background: rgba(14, 165, 233, 0.08);
    color: var(--color-brand-600, #0284c7);
    border: 1px solid rgba(14, 165, 233, 0.2);
    border-radius: 9999px;
    font-size: 0.78rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.15s ease;
}
.guide-quick-pill:hover {
    background: var(--color-brand-500, #0ea5e9);
    color: #fff;
    text-decoration: none;
}

.guide-layout {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 1.5rem;
    align-items: start;
}

.guide-nav-sidebar {
    position: sticky;
    top: calc(var(--header-height, 64px) + 1.5rem);
}

.guide-nav-card {
    padding: 1.25rem;
}

.guide-toc {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.guide-toc-link {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.55rem 0.75rem;
    border-radius: var(--radius-md);
    color: var(--color-text-secondary);
    font-size: 0.86rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.15s ease;
}
.guide-toc-link:hover {
    background: rgba(14, 165, 233, 0.08);
    color: var(--color-brand-600, #0284c7);
    text-decoration: none;
}
.guide-toc-link.active {
    background: rgba(14, 165, 233, 0.12);
    color: var(--color-brand-600, #0284c7);
    font-weight: 600;
    border-left: 3px solid var(--color-brand-500, #0ea5e9);
}

.toc-num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: rgba(14, 165, 233, 0.1);
    color: var(--color-brand-600, #0284c7);
    font-size: 0.75rem;
    font-weight: 700;
    flex-shrink: 0;
    transition: all 0.15s ease;
}
.guide-toc-link.active .toc-num {
    background: var(--color-brand-500, #0ea5e9);
    color: #fff;
}

.guide-content-area {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.guide-section {
    scroll-margin-top: calc(var(--header-height, 64px) + 1rem);
}

.guide-section-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.guide-num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: var(--color-brand-500, #0ea5e9);
    color: #fff;
    font-size: 0.85rem;
    font-weight: 700;
}

.guide-subtitle {
    font-size: 1rem;
    font-weight: 600;
    margin: 1.25rem 0 0.5rem 0;
    color: var(--color-text-primary);
}

.guide-body {
    font-size: 0.92rem;
    line-height: 1.75;
    color: var(--color-text-secondary);
}

.guide-body p {
    margin-bottom: 0.85rem;
}

.guide-role-card {
    padding: 1rem;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-md);
    background: var(--color-bg-surface, #f8fafc);
}

.guide-role-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.5rem;
}

.guide-steps {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-top: 0.75rem;
}

.guide-step-item {
    display: flex;
    gap: 1rem;
    padding: 0.85rem;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-md);
    background: var(--color-bg-surface, #f8fafc);
    align-items: flex-start;
}

.guide-step-badge {
    background: var(--color-brand-500, #0ea5e9);
    color: #fff;
    padding: 0.2rem 0.55rem;
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    flex-shrink: 0;
    margin-top: 0.1rem;
}

.guide-step-content {
    font-size: 0.88rem;
    line-height: 1.6;
}

.guide-callout {
    display: flex;
    gap: 0.85rem;
    padding: 0.9rem 1.15rem;
    border-radius: var(--radius-md);
    font-size: 0.88rem;
    line-height: 1.6;
    margin: 1rem 0;
}
.guide-callout-icon {
    font-size: 1.25rem;
    flex-shrink: 0;
}
.guide-callout.info {
    background: rgba(14, 165, 233, 0.06);
    border-left: 4px solid var(--color-brand-500, #0ea5e9);
    color: var(--color-text-primary);
}
.guide-callout.warning {
    background: rgba(245, 158, 11, 0.08);
    border-left: 4px solid #f59e0b;
    color: var(--color-text-primary);
}
.guide-callout.error {
    background: rgba(239, 68, 68, 0.08);
    border-left: 4px solid #ef4444;
    color: var(--color-text-primary);
}

.guide-faq-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.guide-faq-item {
    border: 1px solid var(--color-border);
    border-radius: var(--radius-md);
    background: var(--color-bg-surface, #f8fafc);
    overflow: hidden;
    transition: all 0.2s ease;
}
.guide-faq-item[open] {
    border-color: var(--color-brand-500, #0ea5e9);
    background: var(--color-bg-card);
}

.guide-faq-question {
    padding: 1rem 1.25rem;
    font-weight: 600;
    font-size: 0.92rem;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    list-style: none;
    user-select: none;
}
.guide-faq-question::-webkit-details-marker {
    display: none;
}
.faq-chevron {
    transition: transform 0.2s ease;
    color: var(--color-text-muted);
}
.guide-faq-item[open] .faq-chevron {
    transform: rotate(180deg);
    color: var(--color-brand-500, #0ea5e9);
}

.guide-faq-answer {
    padding: 0 1.25rem 1rem 1.25rem;
    font-size: 0.88rem;
    line-height: 1.65;
    color: var(--color-text-secondary);
}

/* Print Styles */
@media print {
    .app-header, .sidebar, .guide-nav-sidebar, .guide-quick-pill, #guideSearchInput, .btn, .app-footer {
        display: none !important;
    }
    .main-content, .page-content, .user-guide-wrapper {
        margin: 0 !important;
        padding: 0 !important;
        max-width: 100% !important;
    }
    .guide-layout {
        display: block !important;
    }
    .card {
        border: 1px solid #ccc !important;
        box-shadow: none !important;
        break-inside: avoid;
        margin-bottom: 1.5rem !important;
    }
}

/* Mobile Responsive */
@media (max-width: 900px) {
    .guide-layout {
        grid-template-columns: 1fr;
    }
    .guide-nav-sidebar {
        position: static;
    }
}
</style>

<script>
function activateToc(element) {
    document.querySelectorAll('.guide-toc-link').forEach(link => link.classList.remove('active'));
    element.classList.add('active');
}

function filterGuideTopics() {
    const query = document.getElementById('guideSearchInput').value.toLowerCase().trim();
    const sections = document.querySelectorAll('.guide-section');
    
    sections.forEach(section => {
        if (!query) {
            section.style.display = '';
            return;
        }
        const text = section.innerText.toLowerCase();
        if (text.includes(query)) {
            section.style.display = '';
        } else {
            section.style.display = 'none';
        }
    });
}

// Auto highlight active TOC item based on scroll position
window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('.guide-section');
    const scrollPos = window.scrollY + 120;
    
    sections.forEach(section => {
        if (section.style.display === 'none') return;
        const top = section.offsetTop;
        const height = section.offsetHeight;
        const id = section.getAttribute('id');
        
        if (scrollPos >= top && scrollPos < top + height) {
            document.querySelectorAll('.guide-toc-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + id) {
                    link.classList.add('active');
                }
            });
        }
    });
});
</script>
@endsection

