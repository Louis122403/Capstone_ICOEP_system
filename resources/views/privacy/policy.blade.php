@extends('layouts.app')

@section('title', $pageTitle . ' — ' . config('icoep.app_name'))

@section('content')
<div class="privacy-wrapper">
    {{-- Page Header --}}
    <div class="page-header animate-fade-in-up">
        <div>
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                <span class="badge badge-brand" style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">
                    Data Privacy Act of 2012 (RA 10173)
                </span>
            </div>
            <h1 class="page-title">Data Privacy Policy</h1>
            <p class="page-subtitle">How we collect, use, and protect your personal data in the ICOEP system.</p>
        </div>
        <div>
            <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm">&larr; Back to Dashboard</a>
        </div>
    </div>

    {{-- Main Document Card --}}
    <div class="card animate-fade-in-up" style="animation-delay: 100ms; max-width: 860px; margin: 0 auto;">
        <div class="card-body privacy-body">

            {{-- 1. Overview --}}
            <div class="privacy-section">
                <h2 class="privacy-heading">1. Overview &amp; Legal Compliance</h2>
                <p>
                    <strong>{{ config('icoep.institution_name') }} ({{ config('icoep.institution_short') }})</strong> is committed to safeguarding your personal data in strict compliance with <strong>Republic Act No. 10173</strong>, also known as the <strong>Data Privacy Act of 2012</strong>, and the guidelines of the National Privacy Commission (NPC).
                </p>
                <p>
                    This policy explains how the <strong>{{ config('icoep.app_full_name') }} ({{ config('icoep.app_name') }})</strong> processes and protects the information of students, faculty, staff, and administrators using our portal.
                </p>
            </div>

            {{-- 2. Information Collected --}}
            <div class="privacy-section">
                <h2 class="privacy-heading">2. Information We Collect</h2>
                <p>We collect only the minimum information necessary to operate campus services:</p>
                <ul class="privacy-list">
                    <li><strong>Account Details:</strong> Full name, institutional email (<code>@ciccebu.edu.ph</code>), student or employee ID number, and academic department.</li>
                    <li><strong>Login Credentials:</strong> Passwords are cryptographically hashed using industry-standard Bcrypt encryption and are never visible to anyone.</li>
                    <li><strong>Facility &amp; Equipment Logs:</strong> Venue reservation requests, requested schedules, purpose of activity, borrowed equipment, and dates needed.</li>
                    <li><strong>Equipment Return Photos:</strong> Clear photos uploaded by borrowers to verify equipment condition upon return.</li>
                    <li><strong>Security Audit Trails:</strong> Login timestamps, IP addresses, and approval/rejection actions recorded to ensure account accountability.</li>
                </ul>
            </div>

            {{-- 3. How We Use Your Information --}}
            <div class="privacy-section">
                <h2 class="privacy-heading">3. How Your Information Is Used</h2>
                <p>Your data is processed strictly for legitimate institutional purposes:</p>
                <ul class="privacy-list">
                    <li>To verify user identity and authorize access according to your assigned role (Student, Faculty, Custodian, Administrator).</li>
                    <li>To process facility reservations, check for scheduling conflicts, and manage venue occupancy.</li>
                    <li>To monitor equipment checkout, active borrows, overdue reminders, and return clearances.</li>
                    <li>To manage event registrations and verify attendance through QR code scanning.</li>
                    <li>To deliver automated system notifications regarding approvals, status updates, and return deadlines.</li>
                </ul>
            </div>

            {{-- 4. Facility & Equipment Privacy Protections --}}
            <div class="privacy-section">
                <h2 class="privacy-heading">4. Facility &amp; Equipment Privacy Safeguards</h2>
                <div class="privacy-highlight">
                    <p style="margin: 0 0 0.5rem 0;">
                        <strong>Public Calendar Privacy:</strong> Public campus calendars and schedules only show whether a venue is <em>Available</em> or <em>Occupied</em>. Your private contact details and student records are never displayed on public screens.
                    </p>
                    <p style="margin: 0;">
                        <strong>Return Photo Security:</strong> Photographs submitted during equipment returns are used strictly by designated custodians to confirm item condition. They are stored securely and never shared with third parties.
                    </p>
                </div>
            </div>

            {{-- 5. Data Subject Rights --}}
            <div class="privacy-section">
                <h2 class="privacy-heading">5. Your Rights Under RA 10173</h2>
                <p>Under the Data Privacy Act of 2012, you are entitled to the following rights as a data subject:</p>
                <div class="privacy-rights-box">
                    <div class="privacy-right-row">
                        <span class="privacy-dot"></span>
                        <span><strong>Right to be Informed:</strong> Know how your data is collected, processed, and safeguarded.</span>
                    </div>
                    <div class="privacy-right-row">
                        <span class="privacy-dot"></span>
                        <span><strong>Right to Access:</strong> Request reasonable access to your personal information stored in the portal.</span>
                    </div>
                    <div class="privacy-right-row">
                        <span class="privacy-dot"></span>
                        <span><strong>Right to Correction:</strong> Request updates or corrections to any inaccurate or outdated information.</span>
                    </div>
                    <div class="privacy-right-row">
                        <span class="privacy-dot"></span>
                        <span><strong>Right to Erasure or Blocking:</strong> Request removal or suspension of data if processed unlawfully.</span>
                    </div>
                    <div class="privacy-right-row">
                        <span class="privacy-dot"></span>
                        <span><strong>Right to File a Complaint:</strong> File a concern with the institutional DPO or National Privacy Commission.</span>
                    </div>
                </div>
            </div>

            {{-- 6. Data Security & Contact --}}
            <div class="privacy-section" style="border-bottom: none; padding-bottom: 0;">
                <h2 class="privacy-heading">6. Security Measures &amp; Contact</h2>
                <p>
                    We implement SSL/TLS encryption, automated brute-force account lockout protection, and role-based access restrictions. Accounts inactive for 14 days are automatically protected with dormant safeguards.
                </p>

                <div class="privacy-contact-box">
                    <div>
                        <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; color: var(--color-text-muted);">
                            Data Protection Officer (DPO)
                        </div>
                        <div style="font-weight: 600; font-size: 0.95rem; margin-top: 0.15rem; color: var(--color-text-primary);">
                            {{ config('icoep.institution_name') }}
                        </div>
                        <div style="font-size: 0.85rem; color: var(--color-text-secondary); margin-top: 0.15rem;">
                            Administration Building, Campus Grounds, Bogo City, Cebu
                        </div>
                    </div>
                    <div style="margin-top: 0.75rem; font-size: 0.88rem;">
                        <span class="text-muted">Inquiries &amp; Privacy Requests:</span>
                        <a href="mailto:dpo@ciccebu.edu.ph" style="color: var(--color-brand-600, #0284c7); font-weight: 600; margin-left: 0.25rem;">
                            dpo@ciccebu.edu.ph
                        </a>
                    </div>
                </div>

                <div style="margin-top: 1.5rem; text-align: center; font-size: 0.8rem; color: var(--color-text-muted);">
                    Last updated: {{ date('F d, Y') }} &bull; In compliance with Republic Act No. 10173
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Simple and Presentable Privacy Policy Styles */
.privacy-wrapper {
    max-width: 900px;
    margin: 0 auto;
}

.privacy-body {
    padding: 2rem !important;
}

.privacy-section {
    padding-bottom: 1.5rem;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid var(--color-border, #e2e8f0);
}

.privacy-heading {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--color-text-primary, #0f172a);
    margin: 0 0 0.75rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.privacy-body p {
    font-size: 0.92rem;
    line-height: 1.7;
    color: var(--color-text-secondary, #334155);
    margin: 0 0 0.75rem 0;
}

.privacy-list {
    margin: 0.5rem 0 0.75rem 1.25rem;
    padding: 0;
    font-size: 0.9rem;
    line-height: 1.75;
    color: var(--color-text-secondary, #334155);
}

.privacy-list li {
    margin-bottom: 0.4rem;
}

.privacy-highlight {
    background: rgba(14, 165, 233, 0.05);
    border-left: 4px solid var(--color-brand-500, #0ea5e9);
    border-radius: var(--radius-md, 8px);
    padding: 1rem 1.25rem;
    margin-top: 0.5rem;
    font-size: 0.9rem;
    line-height: 1.65;
    color: var(--color-text-secondary, #334155);
}

.privacy-rights-box {
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
    margin-top: 0.75rem;
    background: var(--color-bg-surface, #f8fafc);
    border: 1px solid var(--color-border, #e2e8f0);
    border-radius: var(--radius-md, 8px);
    padding: 1rem 1.25rem;
}

.privacy-right-row {
    display: flex;
    align-items: flex-start;
    gap: 0.65rem;
    font-size: 0.88rem;
    line-height: 1.6;
    color: var(--color-text-secondary, #334155);
}

.privacy-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--color-brand-500, #0ea5e9);
    margin-top: 0.45rem;
    flex-shrink: 0;
}

.privacy-contact-box {
    background: var(--color-bg-surface, #f8fafc);
    border: 1px solid var(--color-border, #e2e8f0);
    border-radius: var(--radius-md, 8px);
    padding: 1.15rem 1.25rem;
    margin-top: 1rem;
}

/* Print Styles */
@media print {
    .app-header, .sidebar, .btn, .app-footer {
        display: none !important;
    }
    .main-content, .page-content, .privacy-wrapper {
        margin: 0 !important;
        padding: 0 !important;
        max-width: 100% !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .privacy-body {
        padding: 0 !important;
    }
}
</style>
@endsection
