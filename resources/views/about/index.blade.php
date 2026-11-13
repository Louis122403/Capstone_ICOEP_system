@extends('layouts.app')

@section('title', $pageTitle . ' — ' . config('icoep.app_name'))

@section('content')
<div class="about-wrapper">
    {{-- Back Button (Left-aligned, above header) --}}
    <div class="animate-fade-in-up" style="margin-bottom: 1.25rem;">
        <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm" style="display: inline-flex; align-items: center; gap: 0.4rem;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Dashboard
        </a>
    </div>

    {{-- Page Header --}}
    <div class="page-header animate-fade-in-up" style="animation-delay: 40ms;">
        <div>
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                <span class="badge badge-brand" style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">
                    Institutional Identity
                </span>
                <span class="badge badge-general" style="font-size: 0.72rem; letter-spacing: 0.03em;">
                    DC-SLMES
                </span>
            </div>
            <h1 class="page-title">About St. Louise de Marillac College of Bogo</h1>
            <p class="page-subtitle">Our history, identity, vision, mission, core values, and institutional graduate attributes.</p>
        </div>
    </div>

    {{-- Main Container --}}
    <div class="about-container animate-fade-in-up" style="animation-delay: 80ms;">

        {{-- 1. Overview & History Card --}}
        <div class="card about-card">
            <div class="card-header about-card-header">
                <div class="about-header-inner">
                    <div class="about-header-icon history-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 21h18"></path>
                            <path d="M9 8h1"></path>
                            <path d="M9 12h1"></path>
                            <path d="M9 16h1"></path>
                            <path d="M14 8h1"></path>
                            <path d="M14 12h1"></path>
                            <path d="M14 16h1"></path>
                            <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path>
                        </svg>
                    </div>
                    <div class="about-header-text">
                        <h2 class="about-section-title">Institutional Overview &amp; History</h2>
                        <p class="about-section-sub">A legacy of Vincentian education, faith, and compassionate service to persons who are poor</p>
                    </div>
                </div>
            </div>
            <div class="card-body about-body">
                <p>
                    <strong>St. Louise de Marillac College of Bogo, Cebu, Inc. (SLMCB)</strong> is a private Catholic educational institution operated by the <strong>Daughters of Charity of Saint Vincent de Paul</strong> under the <strong>Daughters of Charity – St. Louise de Marillac Educational System (DC-SLMES)</strong>.
                </p>
                <p>
                    The roots of the institution date back to <strong>1936</strong> when <strong>Sor Dorotea L. Rubio, D.C.</strong>, a native of Bogo spurred by deep compassion and love for the poor, founded the <em>Beneficencia de la Sagrada Familia</em>. The institution was established to care for orphans and provide Christian and Vincentian education to the young and deserving girls of the town. Inspired by her missionary fervor, her sister, <strong>Do&ntilde;a Raquel Rubio viuda de Sanchez</strong>, generously made available the building that inaugurated the <em>Escuela de la Sagrada Familia</em>.
                </p>
                <p>
                    Through decades of academic excellence and spiritual ministry, the school was duly recognized by the government, operating as the <em>Holy Family Academy</em> before being renamed <strong>St. Louise de Marillac College of Bogo</strong> in honor of the Co-Foundress of the Daughters of Charity. Today, SLMCB continues to form leaders across basic education, higher education, and technical programs who live out the Gospel in solidarity with the less privileged.
                </p>

            </div>
        </div>

        {{-- 2. Vision & Mission Grid (2 Columns) --}}
        <div class="about-vm-grid">
            {{-- Vision --}}
            <div class="card about-card vm-card">
                <div class="card-header about-card-header">
                    <div class="about-header-inner">
                        <div class="about-header-icon vision-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </div>
                        <div class="about-header-text">
                            <h2 class="about-section-title">Our Vision</h2>
                            <span class="badge badge-brand header-tag-badge">Empowering &bull; Christ-Centered</span>
                        </div>
                    </div>
                </div>
                <div class="card-body about-body text-center-body">
                    <div class="statement-quote-box">
                        <p class="statement-quote">
                            &ldquo;St. Louise de Marillac College of Bogo, Cebu, Inc. is an empowering Christ-centered Vincentian learning institution.&rdquo;
                        </p>
                    </div>
                    <p class="statement-desc">
                        As an educational arm of the Catholic Church, SLMCB fosters an environment where faith, moral conviction, and academic excellence empower learners to realize their fullest potential.
                    </p>
                </div>
            </div>

            {{-- Mission --}}
            <div class="card about-card vm-card">
                <div class="card-header about-card-header">
                    <div class="about-header-inner">
                        <div class="about-header-icon mission-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </div>
                        <div class="about-header-text">
                            <h2 class="about-section-title">Our Mission</h2>
                            <span class="badge badge-success header-tag-badge">Action-Oriented &bull; Servant Leadership</span>
                        </div>
                    </div>
                </div>
                <div class="card-body about-body text-center-body">
                    <div class="statement-quote-box">
                        <p class="statement-quote">
                            &ldquo;We commit to engaging the community of learners into becoming inner-directed, globally competent Vincentian leaders who journey with persons living in poverty situations and care for God's creation.&rdquo;
                        </p>
                    </div>
                    <p class="statement-desc">
                        Through transformative teaching and active community immersion, we nurture graduates dedicated to social justice, integral ecology, and responsive service.
                    </p>
                </div>
            </div>
        </div>

        {{-- 3. Core Values Card (3 Columns) --}}
        <div class="card about-card">
            <div class="card-header about-card-header">
                <div class="about-header-inner">
                    <div class="about-header-icon values-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <div class="about-header-text">
                        <h2 class="about-section-title">Core Values</h2>
                        <p class="about-section-sub">The guiding pillars of the Daughters of Charity &amp; Vincentian educational ministry</p>
                    </div>
                </div>
            </div>
            <div class="card-body about-body">
                <div class="values-grid">
                    {{-- 1. Respect --}}
                    <div class="value-item">
                        <div class="value-num-pill">1</div>
                        <h3 class="value-title">Respect</h3>
                        <p class="value-desc">
                            Upholding human dignity, providing a safe and nurturing learning environment through holistic human development and reverent care for God's creation towards an integral ecology.
                        </p>
                    </div>

                    {{-- 2. Simplicity --}}
                    <div class="value-item">
                        <div class="value-num-pill">2</div>
                        <h3 class="value-title">Simplicity</h3>
                        <p class="value-desc">
                            A lifestyle that witnesses to truth, integrity, and honesty; cultivating transparency in relationships and living contentedly in harmony with real needs and genuine modesty.
                        </p>
                    </div>

                    {{-- 3. Service --}}
                    <div class="value-item">
                        <div class="value-num-pill">3</div>
                        <h3 class="value-title">Service</h3>
                        <p class="value-desc">
                            An expression of selfless love, compassion, and active solidarity with persons living in poverty situations through shared social responsibility, accountability, and collaborative networking.
                        </p>
                    </div>
                </div>

                {{-- Complementary Values Row --}}
                <div class="enabling-values-box">
                    <span class="enabling-label">Complementary Vincentian Values:</span>
                    <div class="enabling-pills">
                        <span class="enabling-pill">Vincentian Excellence</span>
                        <span class="enabling-pill">Compassionate Service</span>
                        <span class="enabling-pill">Co-Responsibility</span>
                        <span class="enabling-pill">Social Commitment</span>
                        <span class="enabling-pill">Solidarity</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. Institutional Graduate Attributes (IGA) (3 Columns) --}}
        <div class="card about-card">
            <div class="card-header about-card-header">
                <div class="about-header-inner">
                    <div class="about-header-icon attributes-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                    </div>
                    <div class="about-header-text">
                        <h2 class="about-section-title">Institutional Graduate Attributes (IGA)</h2>
                        <p class="about-section-sub">Three foundational pillars formed in every St. Louise de Marillac College graduate</p>
                    </div>
                </div>
            </div>
            <div class="card-body about-body">
                <p class="attributes-intro">
                    Every student who completes their education at SLMCB is formed along three foundational pillars, equipping them for lifelong success, service, and ethical leadership:
                </p>

                <div class="attributes-grid">
                    {{-- Attribute 1: Christ-Centered --}}
                    <div class="attribute-card">
                        <div class="attribute-header">
                            <span class="attribute-badge">Attribute 1</span>
                            <h3 class="attribute-title">Christ-Centered</h3>
                            <span class="attribute-tag">Faith-Grounded &bull; Inner-Directed</span>
                        </div>
                        <ul class="attribute-list">
                            <li>Recognizes the face of Christ in every human person, especially the poor and vulnerable.</li>
                            <li>Exercises moral discernment, truthfulness, and integrity in personal and professional choices.</li>
                            <li>Grounded in prayer, spiritual reflection, and active Christian discipleship.</li>
                        </ul>
                    </div>

                    {{-- Attribute 2: Charitable --}}
                    <div class="attribute-card">
                        <div class="attribute-header">
                            <span class="attribute-badge">Attribute 2</span>
                            <h3 class="attribute-title">Charitable</h3>
                            <span class="attribute-tag">Compassionate &bull; Social Advocate</span>
                        </div>
                        <ul class="attribute-list">
                            <li>Walks in active solidarity with persons living in poverty situations without prejudice.</li>
                            <li>Champions social justice, human rights, and equitable community empowerment.</li>
                            <li>Practices faithful ecological stewardship and proactive care for God's creation.</li>
                        </ul>
                    </div>

                    {{-- Attribute 3: Competent --}}
                    <div class="attribute-card">
                        <div class="attribute-header">
                            <span class="attribute-badge">Attribute 3</span>
                            <h3 class="attribute-title">Competent</h3>
                            <span class="attribute-tag">Globally Competent &bull; Innovative</span>
                        </div>
                        <ul class="attribute-list">
                            <li>Applies critical thinking, evidence-based analysis, and innovative problem-solving.</li>
                            <li>Mastery in their academic and professional disciplines with modern digital literacy.</li>
                            <li>Acts as an adaptable, collaborative, and transformative leader in a dynamic world.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
/* ═══════════ ABOUT US PAGE STYLES ═══════════ */
.about-wrapper {
    max-width: 1040px;
    margin: 0 auto;
    padding-bottom: 2.5rem;
}

/* Container */
.about-container {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* Cards */
.about-card {
    border: 1px solid var(--color-surface-200, #e2e8f0);
    border-radius: var(--radius-lg, 12px);
    background: var(--bg-card, #ffffff);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    overflow: hidden;
    transition: background 0.2s ease, border-color 0.2s ease;
}

/* ─── CARD HEADERS (CENTERED GROUP - NO AWKWARD GAP) ─── */
.card-header.about-card-header {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 1.25rem 1.5rem !important;
    border-bottom: 1px solid var(--color-surface-200, #e2e8f0) !important;
    background: var(--color-surface-50, #f8fafc) !important;
}

.about-header-inner {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.85rem;
    text-align: left;
}

@media (max-width: 640px) {
    .about-header-inner {
        flex-direction: column;
        text-align: center;
    }
}

.about-header-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(14, 165, 233, 0.12);
    color: var(--color-brand-600, #0284c7);
    flex-shrink: 0;
}

.about-header-icon.history-icon {
    background: rgba(14, 165, 233, 0.12);
    color: var(--color-brand-600, #0284c7);
}

.about-header-icon.vision-icon {
    background: rgba(59, 130, 246, 0.12);
    color: #2563eb;
}

.about-header-icon.mission-icon {
    background: rgba(16, 185, 129, 0.12);
    color: #059669;
}

.about-header-icon.values-icon {
    background: rgba(245, 158, 11, 0.12);
    color: #d97706;
}

.about-header-icon.attributes-icon {
    background: rgba(139, 92, 246, 0.12);
    color: #7c3aed;
}

.about-header-text {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.about-section-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--color-surface-900, #0f172a);
    margin: 0;
}

.about-section-sub {
    font-size: 0.8125rem;
    color: var(--color-surface-500, #64748b);
    margin: 2px 0 0;
}

.header-tag-badge {
    margin-top: 0.25rem;
    font-size: 0.68rem;
    letter-spacing: 0.03em;
    align-self: flex-start;
}

@media (max-width: 640px) {
    .header-tag-badge {
        align-self: center;
    }
}

/* Card Body */
.about-body {
    padding: 1.5rem;
    font-size: 0.925rem;
    line-height: 1.7;
    color: var(--color-surface-700, #334155);
}

.about-body p {
    margin: 0 0 1rem;
}

.about-body p:last-child {
    margin-bottom: 0;
}

/* Seal Callout */
.about-callout {
    margin-top: 1.5rem;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    background: rgba(14, 165, 233, 0.05);
    border: 1px solid rgba(14, 165, 233, 0.2);
    border-radius: 10px;
}

.about-callout-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: rgba(14, 165, 233, 0.12);
    color: var(--color-brand-600, #0284c7);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
}

.about-callout-content {
    flex: 1;
}

.about-callout-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-surface-900, #0f172a);
    margin: 0 0 0.35rem;
}

.about-callout-text {
    font-size: 0.875rem;
    line-height: 1.6;
    color: var(--color-surface-600, #475569);
    margin: 0 0 0.65rem !important;
}

.motto-badge {
    display: inline-block;
    padding: 0.35rem 0.95rem;
    background: var(--color-surface-50, #f8fafc);
    border: 1px solid rgba(14, 165, 233, 0.3);
    border-radius: 9999px;
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--color-brand-600, #0284c7);
}

/* ─── 2-COLUMN GRID (VISION & MISSION) ─── */
.about-vm-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

@media (min-width: 768px) {
    .about-vm-grid {
        grid-template-columns: 1fr 1fr;
    }
}

.vm-card {
    display: flex;
    flex-direction: column;
}

.text-center-body {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    flex: 1;
}

.statement-quote-box {
    background: var(--color-surface-50, #f8fafc);
    border: 1px solid var(--color-surface-200, #e2e8f0);
    border-top: 3px solid var(--color-brand-500, #0ea5e9);
    border-radius: 10px;
    padding: 1.15rem 1.25rem;
    width: 100%;
    margin-bottom: 0.75rem;
}

.statement-quote {
    font-size: 0.98rem;
    font-weight: 600;
    font-style: italic;
    color: var(--color-surface-900, #0f172a);
    line-height: 1.6;
    margin: 0 !important;
    text-align: center;
}

.statement-desc {
    font-size: 0.88rem;
    color: var(--color-surface-600, #475569);
    line-height: 1.6;
    margin: 0;
    text-align: center;
}

/* ─── 3-COLUMN GRID (CORE VALUES) ─── */
.values-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.25rem;
}

@media (min-width: 820px) {
    .values-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.value-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 1.5rem 1.25rem;
    background: var(--color-surface-50, #f8fafc);
    border: 1px solid var(--color-surface-200, #e2e8f0);
    border-radius: 10px;
    transition: transform 0.2s ease, border-color 0.2s ease;
}

.value-item:hover {
    border-color: var(--color-brand-400, #38bdf8);
}

.value-num-pill {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: var(--color-brand-500, #0ea5e9);
    color: #fff;
    font-size: 0.9rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.75rem;
}

.value-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--color-surface-900, #0f172a);
    margin: 0 0 0.4rem;
    text-align: center;
}

.value-desc {
    font-size: 0.88rem;
    line-height: 1.6;
    color: var(--color-surface-600, #475569);
    margin: 0 !important;
    text-align: center;
}

.enabling-values-box {
    margin-top: 1.5rem;
    padding: 0.875rem 1.15rem;
    background: rgba(14, 165, 233, 0.04);
    border: 1px dashed var(--color-surface-300, #cbd5e1);
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 0.5rem;
}

@media (min-width: 640px) {
    .enabling-values-box {
        flex-direction: row;
        justify-content: center;
    }
}

.enabling-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--color-surface-500, #64748b);
}

.enabling-pills {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.4rem;
}

.enabling-pill {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--color-brand-700, #0369a1);
    background: rgba(14, 165, 233, 0.12);
    padding: 0.25rem 0.65rem;
    border-radius: 9999px;
}

/* ─── 3-COLUMN GRID (GRADUATE ATTRIBUTES) ─── */
.attributes-intro {
    text-align: center;
    max-width: 780px;
    margin: 0 auto 1.5rem;
    font-size: 0.925rem;
    color: var(--color-surface-600, #475569);
}

.attributes-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.25rem;
}

@media (min-width: 820px) {
    .attributes-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.attribute-card {
    background: var(--color-surface-50, #f8fafc);
    border: 1px solid var(--color-surface-200, #e2e8f0);
    border-radius: 10px;
    padding: 1.35rem 1.15rem;
    display: flex;
    flex-direction: column;
}

.attribute-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-bottom: 0.85rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--color-surface-200, #e2e8f0);
}

.attribute-badge {
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #7c3aed;
    background: rgba(139, 92, 246, 0.12);
    padding: 0.2rem 0.55rem;
    border-radius: 9999px;
    margin-bottom: 0.35rem;
}

.attribute-title {
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--color-surface-900, #0f172a);
    margin: 0 0 0.2rem;
    text-align: center;
}

.attribute-tag {
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--color-surface-500, #64748b);
    text-align: center;
}

.attribute-list {
    margin: 0;
    padding-left: 1.15rem;
    font-size: 0.85rem;
    line-height: 1.6;
    color: var(--color-surface-600, #475569);
    display: flex;
    flex-direction: column;
    gap: 0.55rem;
    flex: 1;
}

/* ═══════════ DARK MODE OVERRIDES ═══════════ */
html.dark .about-card {
    background: #0f172a;
    border-color: rgba(255, 255, 255, 0.08);
}

html.dark .card-header.about-card-header {
    background: #0b1526 !important;
    border-bottom-color: rgba(255, 255, 255, 0.08) !important;
}

html.dark .about-section-title {
    color: #f1f5f9;
}

html.dark .about-section-sub {
    color: #94a3b8;
}

html.dark .about-body {
    color: #cbd5e1;
}

html.dark .about-callout {
    background: rgba(14, 165, 233, 0.08);
    border-color: rgba(14, 165, 233, 0.25);
}

html.dark .about-callout-title {
    color: #f1f5f9;
}

html.dark .about-callout-text {
    color: #94a3b8;
}

html.dark .motto-badge {
    background: #0b1526;
    border-color: rgba(14, 165, 233, 0.35);
    color: #38bdf8;
}

html.dark .statement-quote-box {
    background: #0b1526;
    border-color: rgba(255, 255, 255, 0.08);
    border-top-color: var(--color-brand-400, #38bdf8);
}

html.dark .statement-quote {
    color: #f1f5f9;
}

html.dark .statement-desc {
    color: #94a3b8;
}

html.dark .value-item {
    background: #0b1526;
    border-color: rgba(255, 255, 255, 0.08);
}

html.dark .value-title {
    color: #f1f5f9;
}

html.dark .value-desc {
    color: #94a3b8;
}

html.dark .enabling-values-box {
    background: rgba(255, 255, 255, 0.02);
    border-color: rgba(255, 255, 255, 0.1);
}

html.dark .enabling-label {
    color: #94a3b8;
}

html.dark .enabling-pill {
    background: rgba(14, 165, 233, 0.2);
    color: #38bdf8;
}

html.dark .attributes-intro {
    color: #94a3b8;
}

html.dark .attribute-card {
    background: #0b1526;
    border-color: rgba(255, 255, 255, 0.08);
}

html.dark .attribute-header {
    border-bottom-color: rgba(255, 255, 255, 0.08);
}

html.dark .attribute-badge {
    background: rgba(139, 92, 246, 0.2);
    color: #a78bfa;
}

html.dark .attribute-title {
    color: #f1f5f9;
}

html.dark .attribute-tag {
    color: #94a3b8;
}

html.dark .attribute-list {
    color: #94a3b8;
}

/* Print Styles */
@media print {
    .sidebar, .btn, .app-footer, .top-navbar {
        display: none !important;
    }
    .main-content, .page-content, .about-wrapper {
        margin: 0 !important;
        padding: 0 !important;
        max-width: 100% !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endsection
